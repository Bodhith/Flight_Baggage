<?php

  function checkProperPath()
  {
    session_start();

    if( isset($_SESSION['userType']) )
    {
      if( $_SESSION['userType'] !== "management" or !isset($_POST['addCustomersSubmit']) )
      {
        header("location: ../");
      }
    }
    else
    {
      header("location: ../");
    }
  }

  function getCustomerDetails()
  {
    $totalUsers = $_POST['totalUsers'];

    require_once("../headers/htmlHeaders.php");
    require_once("../headers/mdb4Headers.php");
    echo '

    <div class="container">
    <form class="border border-light p-5" action="addCustomers.php" method="post">
      <input type="hidden" name="totalUsers" value='.$totalUsers.'>
    ';

    for($x=0; $x<$totalUsers; $x++)
    {
      echo '
        <p class="h4 mb-4 text-center">Enter details of user '.($x+1).'</p>
        Username : <input type="text"  class="form-control form-row" name="username_'.$x.'"> <br>
        Mobile : <input type="number"  class="form-control form-row" name="userMobile_'.$x.'"> <br>
        Current Airport : <select class="browser-default custom-select mb-4" name="currentAirport_'.$x.'"><option value="airport_0">airport 0</option><option value="airport_1">airport 1</option></select> <br>
        Destination airport : <select  class="browser-default custom-select mb-4" name="desitnationAirport_'.$x.'"><option value="airport_0">airport 0</option><option value="airport_1">airport 1</option></select> <br>
        Number of bags : <input  class="form-control mb-4" type="number" name="userBags_'.$x.'"> <br>
      ';
    }

    echo '
      <input type="submit" class="btn btn-info btn-block" name="addCustomerDetailsSubmit" value="SAVE">
      </div>
    </form>
    ';
  }

  checkProperPath();
  getCustomerDetails();

 ?>
