<?php

  function checkProperPath()
  {
    session_start();

    if( isset($_SESSION['userType']) )
    {
      if( $_SESSION['userType'] !== "management" or !isset($_POST['mainLogSubmit']) )
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

    require_once("../misc/runQueries.php");
    $result = runQuery("SELECT userId, verdict from rfids where 1;");

    $usersVerdicts = [];

    while( $row = $result->fetch_assoc() )
    {
      $usersVerdicts[$row['userId']] = $row['verdict'];
    }

    $tableData = [];

    foreach($logs as $log)
    {

      //  check if managementUser belongs to the corresponding user aiport, else, it is a breach if management use could acces ever user.

      if( $log->getUser()->getTicket()->getRoute()[0] === $_SESSION['airportName'] or $log->getUser()->getTicket()->getRoute()[1] === $_SESSION['airportName'] )
      {
        $userId = $log->getUser()->getId();

        $tableData[$userId]['User Name'] = $log->getUser()->getName();
        $tableData[$userId]['User Mobile'] = $log->getUser()->getMobile();
        $tableData[$userId]['User Pnr'] = $log->getUser()->getTicket()->getPnr();
        $tableData[$userId]['Verdict'] = $usersVerdicts[$userId];

        foreach($log->getRfid() as $rfid => $bagId)
        {
            $tableData[$userId]['Attached Rfids'][$bagId] = $rfid;
        }

        $tableData[$userId]['Route'] = $log->getRoute()[$rfid];

        foreach($log->getTimestamp()[$rfid] as $route => $timeStamp)
        {
           $tableData[$userId]['Timestamp'][$route] = $timeStamp;
        }
      }
    }

    /*require_once("../misc/debug.php");
    debugVar($logs);*/

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
           <script src="mainLog.js"></script>
         </head>
         <body class="mt-5 ml-5 mr-5">
           <form id="formTableData">

           </form>
         </body>
       </html>
    ';
  }

  checkProperPath();
  $table = prepareLog();
  printTable($table);
 ?>
