<?php

  function runQuery($query)
  {
    require_once("D:/XAMP/XAMP_7.3.1/htdocs/FLIGHT BAGGAGE/database.php");

    $con = OpenCon();
    
    $result = mysqli_query($con, $query);

    CloseCon($con);

    return $result;
  }

 ?>
