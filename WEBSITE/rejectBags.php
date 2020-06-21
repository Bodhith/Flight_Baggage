<?php

  function checkProperPath()
  {
    session_start();

    if( isset($_SESSION['userType']) )
    {
      if( $_SESSION['userType'] !== "management" or !(isset($_POST['tableDataSubmit_Reject']) xor isset($_POST['tableDataSubmit_Pass'])) )
      {
        header("location: ../");
      }
    }
    else
    {
      header("location: ../");
    }
  }

  function rejectBags()
  {
    $logs = [];

    $totalUsers = $_POST['totalUsers'];
    $verdicts = $_POST['verdicts'];

    $x = 0;

    $userVerdicts = json_decode($verdicts, true);

    foreach($_POST as $userId=>$verdict)
    {
      if( $x >= 3 and isset($_POST['tableDataSubmit_Pass']) )
      {
        $userVerdicts[$userId] = "Passed";
      }

      else if( $x >= 3 and isset($_POST['tableDataSubmit_Reject']) )
      {
        $userVerdicts[$userId] = "Rejected";
      }

      $x++;
    }

    //    simulate users who passed the security check

    require_once("../headers/systemMacros.php");
    require_once("../sim/sim.php");
    $system = unserialize(file_get_contents("../sim/system"));
    if( file_exists("../sim/log") )
    {
      $logs = unserialize(file_get_contents("../sim/log"));

      unlink("../sim/log");
    }

    require_once("../misc/runQueries.php");

    foreach($userVerdicts as $userId => $verdict)
    {
      $result = runQuery('UPDATE rfids SET verdict="'.$verdict.'" WHERE userId='.$userId.';');

      for($x=0; $x<sizeof($logs); $x++)
      {
        for($y=$x+1; $y<sizeof($logs); $y++)
        {
          if( isset($logs[$x], $logs[$y]) and $logs[$x]->getUser()->getId() == $logs[$y]->getUser()->getId() )
          {
            unset($logs[$x]);
          }
        }
      }

      array_push($logs, runSimulation($system, $system[users][$userId], $verdict));
    }

    file_put_contents("../sim/log", serialize($logs));

    header("location: ../website/managementHome.php");

  }

  checkProperPath();
  rejectBags();

 ?>
