<?php

  function checkProperPath()
  {
    session_start();

    if( isset($_SESSION['userType']) )
    {
      if( $_SESSION['userType'] !== "customer" or !isset($_POST['collectBagSubmit']) )
      {
        header("location: ../");
      }
    }
    else
    {
      header("location: ../");
    }
  }

  function collectBag()
  {
    require_once("../sim/sim.php");

    $systemFilePath = "../sim/system";
    $logFilePath = "../sim/log";

    $system = unserialize(file_get_contents($systemFilePath));
    $logs = unserialize(file_get_contents($logFilePath));

    date_default_timezone_set('Asia/Kolkata');
    $timestamp = new DateTime();

    $userId = $_SESSION['userId'];

    require_once("../headers/systemMacros.php");

    foreach($logs as $log)
    {
      if( $log->getUser()->getId() == $userId )
      {
        $departureAirport = $system[airports]->getAirportByName($log->getUser()->getticket()->getRoute()[1]);

        foreach( $log->getRfid() as $rfid => $bagId )
        {
          foreach( $log->getRoute()[$rfid] as $route )
          {
            if( $departureAirport->getCollectionCarouselIdByName($route) !== -1 )
            {
              $departureAirport->getCollectionCarousels()[$departureAirport->getCollectionCarouselIdByName($route)]->setPickedRfids($rfid);
              $log->setTimestamp($rfid, $route, $timestamp->format("H:m:s.v d-M-Y"));
            }

            if( $departureAirport->getExitGateIdByName($route) !== -1 )
            {
              $departureAirport->getExitGates()[$departureAirport->getExitGateIdByName($route)]->setRfids($rfid);
              $log->setTimestamp($rfid, $route, $timestamp->format("H:m:s.v d-M-Y"));
            }
          }
        }

        break;
      }
    }

    file_put_contents($logFilePath, serialize($logs));
    file_put_contents($systemFilePath, serialize($system));

    header("location: ../website/customerFunctions.php");
  }

  checkProperPath();
  collectBag();
  require_once("../misc/debug.php");

 ?>
