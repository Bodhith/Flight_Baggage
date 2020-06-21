<?php

if( isset($_POST['submit']) )
{
  require_once('misc/runQueries.php');

  $username = $_POST['username'];

  $password = $_POST['password'];

  $result = runQuery("SELECT userId, username, password, userType from userDetails;");

  while($row = $result->fetch_assoc())
  {
    if($row['username'] === $username and $row['password'] === $password )
    {
      session_start();

      if( $row['userType'] === "customer" )
      {
        echo "customer Login";

        $result = runQuery("SELECT userId, airportId from userDetails where userId = ".$row['userId']." and userType = 'customer';");

        while($row = $result->fetch_assoc())
        {
          $_SESSION['airportId'] = $row['airportId'];
          $_SESSION['userId'] = $row['userId'];
        }

        $_SESSION['userType'] = "customer";

        header("location: website/customerFunctions.php");
      }

      else if( $row['userType'] === "management" )
      {
        echo "management Login";

        $result = runQuery("SELECT airportId from userDetails where userId = ".$row['userId']." and userType = 'management';");

        while($row = $result->fetch_assoc())
        {
          $_SESSION['airportId'] = $row['airportId'];
        }

        $result = runQuery("SELECT airportName from airports where ".$_SESSION['airportId']." = airportId;");

        while($row = $result->fetch_assoc())
        {
          $_SESSION['airportName'] = $row['airportName'];
        }

        $_SESSION['userType'] = "management";


        header("location: website/managementHome.php");
      }
    }
  }
}

else {

  echo "Follow the execution FLOW";

  //header("Location: index.php");
}

?>
