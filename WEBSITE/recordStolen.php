<?php

  function checkProperPath()
  {
    session_start();

    if( isset($_SESSION['userType']) )
    {
      if( $_SESSION['userType'] !== "customer"  or !isset($_POST['formReportTableSubmit']) )
      {
        header("location: ../");
      }
    }
    else
    {
      header("location: ../");
    }
  }

  function recordStolen()
  {
    require_once("../misc/runQueries.php");
    require_once("../misc/debug.php");

    $userId = $_SESSION['userId'];
    $userRfids = json_decode($_POST['userRfids'], 1);

    $x = 0;

    foreach($_POST as $bagId => $status)
    {
      if( $x >= 2 )
      {
        $result = runQuery("INSERT INTO stolenrfids(rfid, bagId, userId) VALUES ('$userRfids[$bagId]','$bagId','$userId');");
      }

      $x++;
    }

    header("location: ../website/customerFunctions.php");
  }

  checkProperPath();
  recordStolen();

 ?>
