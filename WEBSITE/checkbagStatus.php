<?php

  function checkProperPath()
  {
    session_start();

    if( isset($_SESSION['userType']) )
    {
      if( $_SESSION['userType'] !== "customer" or !isset($_POST['checkBagStatusSubmit']) )
      {
        header("location: ../");
      }
    }
    else
    {
      header("location: ../");
    }
  }

  function prepareLog()
  {
    require_once("../headers/systemMacros.php");
    require_once("../sim/sim.php");

    $logs = unserialize(file_get_contents("../sim/log"));
    $system = unserialize(file_get_contents("../sim/system"));

    $tableData = [];

    $userId = $_SESSION['userId'];

    $tableData[$userId]['bags'] = [];

    foreach($logs as $log)
    {
      if( $log->getUser()->getId() == $userId )
      {
        $currentAirport = $system[airports]->getAirportByName($log->getUser()->getTicket()->getRoute()[0]);
        $desitnationAirport = $system[airports]->getAirportByName($log->getUser()->getTicket()->getRoute()[1]);

        require_once("../misc/runQueries.php");
        $result = runQuery("SELECT bagId, rfid FROM stolenrfids where userId=$userId");

        $isStolenBag = [];

        while($result and $row = $result->fetch_assoc())
        {
          $isStolenBag[$row['bagId']] = $row['rfid'];
        }

        foreach($log->getRfid() as $rfid => $bagId)
        {
          array_push($tableData[$userId]['bags'], $bagId);
          $order = 0;
          foreach($log->getTimestamp()[$rfid] as $route => $timestamp)
          {
            if( $currentAirport->getSecurityCheckIdByName($route) !== -1 and $order == 0)
            {
              $tableData[$userId]['status'][$rfid] = [];

              array_push($tableData[$userId]['status'][$rfid], array($log->getTimestamp()[$rfid][$route], "Reached Security Check."));

              $order++;
            }

            else if( $currentAirport->getGateIdByName($route) !== -1 and $order == 1)
            {
              array_push($tableData[$userId]['status'][$rfid], array($log->getTimestamp()[$rfid][$route],  "Reached the gate, about to be loaded Onboard."));

              $order++;
            }

            else if( $currentAirport->getPlaneIdByName($route) !== -1 and $order == 2)
            {
              array_push($tableData[$userId]['status'][$rfid], array($log->getTimestamp()[$rfid][$route], "Baggage onboarded, ready to be departed."));

              $order++;
            }

            else if( $desitnationAirport->getGateIdByName($route) !== -1 and $order == 3)
            {
              array_push($tableData[$userId]['status'][$rfid], array($log->getTimestamp()[$rfid][$route], "Baggage reached the destination Airport."));

              $order++;
            }
            else if( $desitnationAirport->getCollectionCarouselIdByName($route) !== -1 and $order == 4)
            {
              array_push($tableData[$userId]['status'][$rfid], array($log->getTimestamp()[$rfid][$route], "Deported successfully, ready to be collected at baggage area."));

              if( isset($isStolenBag[$bagId]) )
              {
                array_push($tableData[$userId]['status'][$rfid], array($log->getTimestamp()[$rfid][$route], "Baggage reported as stolen, authorities are informed."));

                continue;
              }

              $order++;
            }
            else if( $desitnationAirport->getExitGateIdByName($route) !== -1 and $order == 5)
            {
              array_push($tableData[$userId]['status'][$rfid], array($log->getTimestamp()[$rfid][$route], "Baggage exited the airport, in correct hands."));

              $order++;
            }
          }
        }
      }
    }

    return $tableData;
  }

  function printTable($tableData)
  {
    require_once("../headers/htmlheaders.php");
    require_once("../headers/mdb4Headers.php");

    echo
    '
       <!DOCTYPE html>
       <html>
         <head>
           <script>var table = '.json_encode($tableData).'</script>
           <script src="checkBagStatus.js"></script>
         </head>
         <body class="mt-5 ml-5 mr-5">
           <form id="formTableData">
           </form>
         </body>
       </html>
    ';
  }

  /*require_once("../sim/sim.php");
  require_once("../misc/debug.php");
  debugVar(unserialize(file_get_contents("../sim/log")));*/

  checkProperPath();
  $table = prepareLog();
  printTable($table);
 ?>
