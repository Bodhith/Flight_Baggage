<?php

  function checkProperPath()
  {
    session_start();

    if( isset($_SESSION['userType']) )
    {
      if( $_SESSION['userType'] !== "customer" or !isset($_POST['reportStolenSubmit']) )
      {
        header("location: ../");
      }
    }
    else
    {
      header("location: ../");
    }
  }

  function reportStolen()
  {
    require_once("../headers/htmlheaders.php");
    require_once("../headers/mdb4Headers.php");

    require_once("../misc/runQueries.php");

    $userId = $_SESSION['userId'];
    $userRfids = [];

    $result = runQuery("SELECT bagId, rfid from rfids where userId=".$userId.";");

    while( $row = $result->fetch_assoc() )
    {
      $userRfids[$row['bagId']] = $row['rfid'];
    }

    $stolenRfids = [];

    $result = runQuery("SELECT bagId, rfid from stolenRfids where userId = ".$userId.";");

    if( $result )
    {
      while( $row = $result->fetch_assoc() )
      {
        $stolenRfids[$row['bagId']] = $row['rfid'];
      }
    }

    echo
    '
      <html>
        <head>
          <script>var userRfids = '.json_encode($userRfids).'</script>
          <script>var stolenRfids = '.json_encode($stolenRfids).'</script>
          <script src="reportStolen.js"></script>
        </head>
        <body>
          <form id="formReportTable" action="recordStolen.php" method="post">
              <button type="submit" id="submit_button" name="formReportTableSubmit" class="btn btn-info">Report Bag</button>
              <input id="userId" name="userRfids" type="hidden" value='.json_encode($userRfids).'>
          </form>
        </body>
      </html>
    ';

  }

  checkProperPath();
  reportStolen();

 ?>
