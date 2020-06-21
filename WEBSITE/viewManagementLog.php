<?php

  function checkProperPath()
  {
    session_start();

    if( isset($_SESSION['userType']) )
    {
      if( $_SESSION['userType'] !== "management" or !isset($_POST['viewManagementLogSubmit']) )
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

    $system = unserialize(file_get_contents("../sim/system"));

    $tableData = [];

    foreach($system[users] as $user)
    {
      //  check if managementUser belongs to the corresponding user aiport, else, it is a breach if management use could acces ever user.

      if( $user->getTicket()->getRoute()[0] === $_SESSION['airportName'] or $user->getTicket()->getRoute()[1] === $_SESSION['airportName'] )
      {
        $userId = $user->getId();

        $tableData[$userId]['User Name'] = $user->getName();                            //    userName
        $tableData[$userId]['User Mobile'] = $user->getMobile();                        //    user mobile
        $tableData[$userId]['User PNR'] = $user->getTicket()->getPnr();                 //    user pnr
        $tableData[$userId]['Departure Airport'] = $user->getTicket()->getRoute()[0];   //    departure aiport
        $tableData[$userId]['Arrival Airport'] = $user->getTicket()->getRoute()[1];     //    arrival airport

        $currentAirport = $system[airports]->getAirportByName($tableData[$userId]['Departure Airport']);

        $userPath = $system[routes][$userId];

        foreach($userPath as $route)
        {
          if($currentAirport->getSecurityCheckIdByName($route) !== -1)
          {
            $securityCheck = $currentAirport->getPosByName($route)[0];

            break;
          }
        }

        require_once("../misc/runQueries.php");
        $result = runQuery("SELECT userId, verdict from rfids");

        $userVerdicts = [];

        while( $row = $result->fetch_assoc() )
        {
          $userVerdicts[$row['userId']] = $row['verdict'];
        }

        $stolenRfids = [];

        $result = runQuery("SELECT rfid from stolenRfids");
        while( $row = $result->fetch_assoc() )
        {
          array_push($stolenRfids, $row['rfid']);
        }

        foreach($user->getBags() as $bag)
        {
          $rfid = $securityCheck->getRfidsVerdicts()[$userId][$bag->getBagId()][0];

          $tableData[$userId]['Attached Rfids'][$rfid] = $userVerdicts[$userId];
        }

      }
    }

      //require_once("../misc/debug.php");
      //debugVar(json_encode($tableData));

    return array($tableData, $userVerdicts, $stolenRfids);

  }

  function printTable($tableData)
  {
    $userVerdicts = $tableData[1];
    $stolenRfids = $tableData[2];
    $tableData = $tableData[0];

    require_once("../headers/htmlheaders.php");
    require_once("../headers/mdb4Headers.php");

    echo
    '
       <!DOCTYPE html>
       <html>
         <head>
           <script>var table = '.json_encode($tableData).'</script>
           <script>var userVerdicts = '.json_encode($userVerdicts).'</script>
           <script>var stolenRfids = '.json_encode($stolenRfids).'</script>
           <script src="viewManagementLog.js"></script>
         </head>
         <body class="mt-5 ml-5 mr-5">
           <form id="formTableData" action="rejectBags.php" method="post">
              <input type="hidden" name="totalUsers" value='.sizeof($tableData).'>
              <input type="hidden" name="verdicts" value='.json_encode($userVerdicts).'>
              <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                <button type="submit" name="tableDataSubmit_Reject" class="btn btn-red">Reject</button>
              </div>
              <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                <button type="submit" name="tableDataSubmit_Pass" class="btn btn-success">Pass</button>
              </div>
           </form>
         </body>
       </html>
    ';
  }

  checkProperPath();
  $table = prepareLog();
  printTable($table);
 ?>
