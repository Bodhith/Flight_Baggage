<?php

  require_once("../models/airportSystem.php");
  require_once("../models/user.php");
  require_once("../models/log.php");

  require_once("../headers/systemMacros.php");

  require_once("../misc/generateRandomVals.php");
  require_once("../misc/routes_maps.php");
  require_once("../misc/debug.php");
  require_once("../misc/pfa.php");

  function makeAirportSystem()
  {
    $totalAirports = 2;     //    make this dynamic at prod

    $airportSystem = new airportSystem();

    $airportSystem = $airportSystem->createAirportSystem($totalAirports);

    return $airportSystem;
  }

  function makeUsers($userDetails, $airportSystem)
  {
    $totalUsers = generateRandomNumber(2, 2);    //    make this as dyanmic in prod

    $users = [];

    $users = user::createUsers($userDetails, $airportSystem);

    return $users;
  }


  function setSystemVariables($userDetails)
  {
      $airportSystem = makeAirportSystem();

      $users = makeUsers($userDetails, $airportSystem);

      $system = array($airportSystem, $users);

      $routingSystem = [];

      foreach($users as $user)
      {
        $currAirportName = $user->getTicket()->getRoute()[0];
        $destAirportName = $user->getTicket()->getRoute()[1];

        $currAirport = $system[airports]->getAirportByName($currAirportName);
        $destAirport = $system[airports]->getAirportByName($destAirportName);

        $totalCheckIns = sizeof($currAirport->getCheckIns());

        $selectedCheckIn = generateRandomNumber(0, $totalCheckIns-1);
        $currentCheckIn = $currAirport->getCheckIns()[$selectedCheckIn];

        $attachedRfids = $currentCheckIn->attachTagToBag($user, $currAirport);

        $userPath = new Dijkstra($airportSystem->getAirportsMap());

        //    selecting the route for bag, and of all the routes, considering the first route

        $userPath = $userPath->shortestPaths($currAirportName, $destAirport->getExitGates()[0]->getExitGateName())[0];

        //    put user security check status as pending

        foreach($userPath as $route)
        {
          if($currAirport->getSecurityCheckIdByName($route) !== -1)
          {
            $currentSecurityCheck = $currAirport->getPosByName($route)[0];

            //    default is set to pending at securityChecks

            foreach($attachedRfids as $bagId => $rfid)
            {
                $currentSecurityCheck->setRfidsVerdicts($user->getId(), $bagId, $rfid, "Pending");
            }
          }
        }

        $routingSystem[$user->getId()] = $userPath;
      }

      array_push($system, $routingSystem);

      return $system;
  }

  function runSimulation($system, $user, $verdict)
  {
    $logItem = new log();

    date_default_timezone_set('Asia/Kolkata');
    $timestamp = new DateTime();

    $logItem->setLogId($user->getId());
    $logItem->setUser($user);

    foreach($user->getBags() as $bag)
    {
      $completeRoute = $system[routes][$user->getId()];
      $route = array_slice($completeRoute, 2);

      $deptAirportName = $user->getTicket()->getRoute()[0];
      $arrAirportName  = $user->getTicket()->getRoute()[1];

      $currentAirport = $system[airports]->getAirportByName($deptAirportName);
      $deptAirport = $system[airports]->getAirportByName($arrAirportName);

      foreach($currentAirport->getSecurityChecks() as $securityCheck)
      {
         if( isset($securityCheck->getRfidsVerdicts()[$user->getId()][$bag->getBagId()]) )
         {
           $bagRfid = $securityCheck->getRfidsVerdicts()[$user->getId()][$bag->getBagId()][0];
         }
      }

      $logItem->setRfid($bagRfid, $bag->getBagId());
      $logItem->setRoute($bagRfid, $completeRoute);

      $departed = false;
      $breakLoop = false;

      foreach($route as $route)
      {
        if( $departed === false )
        {
          $currPosObject = $currentAirport->getPosByName($route);

          foreach($currPosObject as $currPosObject)
          {

            $logItem->setTimestamp($bagRfid, $route, $timestamp->format("H:m:s.v d-M-Y"));

            if($currentAirport->getSecurityCheckIdByName($route) !== -1)
            {
                $currentSecurityCheck = $currentAirport->getPosByName($route)[0];

                $currentSecurityCheck->setRfidsVerdicts($user->getId(), $bag->getBagId(), $bagRfid, $verdict);

                if( $verdict === "Pending" or $verdict === "Rejected" )
                {
                  $breakLoop = true;

                  break;
                }
             }
             else
             {
               $currPosObject->setRfids($bagRfid);
             }
          }

          if( $breakLoop === true )
          {
            break;
          }

          if($currentAirport->getPlaneIdByName($route) !== -1)
          {
            $departed = true;
          }

        }

        else
        {
          $departed = true;

          $currPosObject = $deptAirport->getPosByName($route);

          foreach($currPosObject as $currPosObject)
          {
              if($deptAirport->getExitGateIdByName($route) !== -1)
              {
                break;
              }

              $currPosObject->setRfids($bagRfid);

              $logItem->setTimestamp($bagRfid, $route, $timestamp->format("H:m:s.v d-M-Y"));

              if($deptAirport->getCollectionCarouselIdByName($route) !== -1)
              {
                require_once("../misc/generateRandomVals.php");
                $isStolen = generateRandomNumber(0, 100);

                if( $isStolen%4 == 0 )
                {
                  $collectionCarouselId = $deptAirport->getCollectionCarouselIdByName($route);
                  $airportId = $deptAirport->getAirportId();
                  $userId = $user->getId();

                  $deptAirport->getCollectionCarousels()[$collectionCarouselId]->setPickedRfids($bagRfid);

                  require_once("../misc/runQueries.php");
                  require_once("../misc/debug.php");
                  $result = runQuery("INSERT INTO exitrfids(rfid, collectionCarouselId, airportId, userId) VALUES ('$bagRfid', $collectionCarouselId, $airportId, $userId);");
                }
              }
          }
        }
      }
    }

    return $logItem;
  }

 ?>
