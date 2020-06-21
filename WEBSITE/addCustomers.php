<?php

  function checkProperPath()
  {
    session_start();

    if( isset($_SESSION['userType']) )
    {
      if( $_SESSION['userType'] !== "management" or !isset($_POST['addCustomerDetailsSubmit']) )
      {
        header("location: ../");
      }
    }
    else
    {
      header("location: ../");
    }
  }

  function addCustomers()
  {

    //    store rfids in debug

    require_once("../headers/systemMacros.php");
    require_once("../misc/runQueries.php");

    $result = runQuery("DELETE FROM rfids where 1;");
    $result = runQuery("DELETE FROM stolenrfids where 1;");
    $result = runQuery("DELETE FROM exitrfids where 1;");

    if( file_exists("../sim/log") )
    {
      unlink("../sim/log");
    }

    if( file_exists("../sim/system") )
    {
      unlink("../sim/system");
    }


    $totalUsers = $_POST['totalUsers'];

    for($x=0; $x<$totalUsers; $x++)
    {
      $userNames[$x] = $_POST['username_'.$x];
      $userMobile[$x] = $_POST['userMobile_'.$x];
      $userRoute[$x] = array($_POST['currentAirport_'.$x], $_POST['desitnationAirport_'.$x]);
      $userBags[$x] = $_POST['userBags_'.$x];
    }

    require_once("../sim/sim.php");

    $userDetails = array($totalUsers, $userNames, $userMobile, $userRoute, $userBags);

    $systemFile = "../sim/system";
    $system = setSystemVariables($userDetails);
    file_put_contents($systemFile, serialize($system));

    foreach($system[users] as $user)
    {
      $currentAirportName = $user->getTicket()->getRoute()[0];

      $currrentAirport = $system[airports]->getAirportByName($currentAirportName);

      foreach($user->getBags() as $bag)
      {
        foreach($currrentAirport->getSecurityChecks() as $securitCheck)
        {
          if( isset($securitCheck->getRfidsVerdicts()[$user->getId()][$bag->getBagId()]) )
          {
            $rfid = $securitCheck->getRfidsVerdicts()[$user->getId()][$bag->getBagId()][0];

            $result = runQuery("INSERT INTO rfids(rfid, airportId, userId, bagId, verdict, reason) VALUE ('{$rfid}',  {$currrentAirport->getAirportId()}, {$user->getId()}, {$bag->getBagId()}, 'Pending','Yet to be scrutinized');");
          }
        }
      }
    }

    //  require_once("../misc/debug.php");
    //  debugVar($system);

    header("location: ../website/managementHome.php");

  }

  checkProperPath();
  addCustomers();
 ?>
