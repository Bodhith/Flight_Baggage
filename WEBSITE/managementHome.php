<?php

  function checkProperPath()
  {
    session_start();

    if( isset($_SESSION['userType']) )
    {
      if( $_SESSION['userType'] !== "management" )
      {
        header("location: ../");
      }
    }
    else
    {
      header("location: ../");
    }
  }

  function resetDBIfRequired()
  {
    $systemPath = "../sim/system";

    if( !file_exists($systemPath) )
    {
      require_once("../misc/runQueries.php");

      $result = runQuery("DELETE FROM `rfids` WHERE 0;");
    }
  }

  /*require_once("../sim/sim.php");
  $content = unserialize(file_get_contents("../sim/log"));
  require_once("../misc/debug.php");
  debugVar($content);*/

  checkProperPath();
  resetDBIfRequired();

  require_once("../headers/htmlHeaders.php");
  require_once("../headers/mdb4Headers.php");
 ?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="managementHome.css">
  </head>
  <body>
    <div class="style="width:600px; margin:0 auto";">
    <form action="addCustomersDetails.php" method="post">
      <div class="def-number-input number-input safari_only">
        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
          <input class="quantity" min="0" name="totalUsers" value="0" type="number">
        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
      </div>
      <input type="submit" class="btn btn-info" name="addCustomersSubmit" value="addCustomers">
    </form>

    <form action="viewManagementLog.php" method="post">
      <input type="submit" class="btn btn-info" name="viewManagementLogSubmit" value="security check">
    </form>

    <form action="mainLog.php" method="post">
      <input type="submit" class="btn btn-info" name="mainLogSubmit" value="Main Log">
    </form>
  </div>
  </body>
</html>
