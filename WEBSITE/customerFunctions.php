<?php

  function checkProperPath()
  {
    session_start();

    if( isset($_SESSION['userType']) )
    {
      if( $_SESSION['userType'] !== "customer" )
      {
        header("location: ../");
      }
    }
    else
    {
      header("location: ../");
    }
  }

  function customerFunctions()
  {
    require_once("../headers/htmlHeaders.php");
    require_once("../headers/mdb4Headers.php");

    echo
    '
      <html>
      <link rel="stylesheet" href="customerFunctions.css">
        <body>
          <form action="reportStolen.php" method="post">
            <input class="btn btn-info" type="submit" name="reportStolenSubmit" value="Report Stolen Bag">
          </form>

          <form action="collectBags.php" method="post">
            <input class="btn btn-info" type="submit" name="collectBagSubmit" value="Collect Bag">
          </form>

          <form action="checkBagStatus.php" method="post">
            <input class="btn btn-info" type="submit" name="checkBagStatusSubmit" value="Check Bag POS">
          </form>

        </body>
      </html>
    ';
  }

  checkProperPath();
  customerFunctions();

 ?>
