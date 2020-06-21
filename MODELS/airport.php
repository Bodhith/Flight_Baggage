<?php

  require_once("../models/checkIn.php");
  require_once("../models/collectionCarousel.php");
  require_once("../models/exitGate.php");
  require_once("../models/gate.php");
  require_once("../models/junction.php");
  require_once("../models/plane.php");
  require_once("../models/securityCheck.php");

  require_once("../misc/generateRandomVals.php");
  require_once("../misc/debug.php");

  class airport
  {
    public $airportId;
    public $airportName;
    public $checkIns;
    public $securityChecks;
    public $junctions;
    public $gates;
    public $collectionCarousels;
    public $exitGates;
    public $planes;

    public $tickets;
    public $rfidTags;
    public $airportMap;


    /**
     * get Pos By Name
     *
     * @param int $name
     *
     */
   function getPosByName($name)
   {
     if( $this->getCheckInIdByName($name) !== -1 )
     {
        return array_filter(
          $this->getCheckIns(),
         function($obj) use($name)
         {
           if( $obj->getCheckInName() === $name )
           {
             return $obj;
           }
         }
       );
     }

     if( $this->getSecurityCheckIdByName($name) !== -1 )
     {
        return array_filter(
          $this->getSecurityChecks(),
         function($obj) use($name)
         {
           if( $obj->getSecurityCheckName() === $name )
           {
             return $obj;
           }
         }
       );
     }

     if( $this->getJunctionIdByName($name) !== -1 )
     {
       return array_filter(
         $this->getJunctions(),
        function($obj) use($name)
        {
          if( $obj->getJunctionName() === $name )
          {
            return $obj;
          }
        }
      );
     }

     if( $this->getGateIdByName($name) !== -1 )
     {
       return array_filter(
         $this->getGates(),
        function($obj) use($name)
        {
          if( $obj->getGateName() === $name )
          {
            return $obj;
          }
        }
      );
     }

     if( $this->getPlaneIdByName($name) !== -1 )
     {
         return array_filter(
           $this->getPlanes(),
          function($obj) use($name)
          {
            if( $obj->getPlaneName() === $name )
            {
              return $obj;
            }
          }
        );
     }

     if( $this->getCollectionCarouselIdByName($name) !== -1 )
     {
         return array_filter(
           $this->getCollectionCarousels(),
          function($obj) use($name)
          {
            if( $obj->getCollectionCarouselName() === $name )
            {
              return $obj;
            }
          }
        );
     }

     if( $this->getExitGateIdByName($name) !== -1 )
     {
         return array_filter(
           $this->getExitGates(),
          function($obj) use($name)
          {
            if( $obj->getExitGateName() === $name )
            {
              return $obj;
            }
          }
        );
     }

     return -1;
   }

    /**
     * get checkIn Id By Name
     *
     * @param int $checkInName
     *
     */
   function getCheckInIdByName($checkInName)
   {
     foreach($this->checkIns as $checkIn)
     {
       if( $checkIn->getCheckInName() === $checkInName )
       {
         return $checkIn->getCheckInId();
       }
     }

     return -1;
   }

    /**
     * get securityCheck Id By Name
     *
     * @param int $securityCheckName
     *
     */
   function getSecurityCheckIdByName($securityCheckName)
   {
     foreach($this->securityChecks as $securityCheck)
     {
       if( $securityCheck->getSecurityCheckName() === $securityCheckName )
       {
         return $securityCheck->getSecurityCheckId();
       }
     }

     return -1;
   }

   /**
    * get Junction Id By Name
    *
    * @param int $junctionName
    *
    */
   function getJunctionIdByName($junctionName)
   {
     foreach($this->junctions as $junction)
     {
       if( $junction->getJunctionName() === $junctionName )
       {
         return $junction->getJunctionId();
       }
     }

     return -1;
   }

   /**
    * get Gate Id By Name
    *
    * @param int $gateName
    *
    */
   function getGateIdByName($gateName)
   {
     foreach($this->gates as $gate)
     {
       if( $gate->getGateName() === $gateName )
       {
         return $gate->getGateId();
       }
     }

     return -1;
   }

   /**
    * get Plane Id By Name
    *
    * @param int $planeName
    *
    */
   function getPlaneIdByName($planeName)
   {
     foreach($this->planes as $plane)
     {
       if( $plane->getPlaneName() === $planeName )
       {
         return $plane->getPlaneId();
       }
     }

     return -1;
   }

   /**
    * get collectionCarousel Id By Name
    *
    * @param int $collectionCarouselName
    *
    */
   function getCollectionCarouselIdByName($collectionCarouselName)
   {
     foreach($this->collectionCarousels as $collectionCarousel)
     {
       if( $collectionCarousel->getCollectionCarouselName() === $collectionCarouselName )
       {
         return $collectionCarousel->getCollectionCarouselId();
       }
     }

     return -1;
   }

   /**
    * get exitGate Id By Name
    *
    * @param int $exitGateIdName
    *
    */
   function getExitGateIdByName($exitGateIdName)
   {
     foreach($this->exitGates as $exitGate)
     {
       if( $exitGate->getExitGateName() === $exitGateIdName )
       {
         return $exitGate->getExitGateId();
       }
     }

     return -1;
   }

    /**
     * create Airports
     *
     * @param int $totalAirports
     *
     */
    public function createAirports($totalAirports)
    {
      $airports = [];

      for($x=0; $x<$totalAirports; $x++)
      {
        $airport = new airport();

        $totalCheckIns = $totalSecurityChecks = 2;          //    make this dyanmic at prod
        $totalGates = $totalCollectionCarousels = $totalExitGates = $totalPlanes = 2;   //    make this dynamic at prod
        $totalJunctions = $totalCollectionCarouselsScanners = 4;    //    make this dyanmic at prod

        $checkIns = checkIn::createCheckIns($totalCheckIns);

        $securityChecks = securityCheck::createSecurityChecks($totalSecurityChecks);

        $junctions = junction::createJunctions($totalJunctions);

        $gates = gate::createGates($totalGates);

        $collectionCarousels = collectionCarousel::createCollectionCarousels($totalCollectionCarousels,
                                                                              $totalCollectionCarouselsScanners);

        $exitGates = exitGate::createExitGates($totalExitGates);

        $planes = plane::createPlanes($totalPlanes);

        $airport->setAirportId($x);
        $airport->setCheckIns($checkIns);
        $airport->setSecurityChecks($securityChecks);
        $airport->setJunctions($junctions);
        $airport->setGates($gates);
        $airport->setCollectionCarousels($collectionCarousels);
        $airport->setExitGates($exitGates);
        $airport->setPlanes($planes);
        $airport->setAirportName("airport_".$x);
        $airport->setAirportMap($airport->createAirportMap());

        array_push($airports, $airport);
      }

      return $airports;

    }

    /**
     * get checkIn Name By Id
     *
     * @param int $checkInId
     *
     */
   function getCheckInNameById($checkInId)
   {
     foreach($this->checkIns as $checkIn)
     {
       if( $checkIn->getCheckInId() === $checkInId )
       {
         return $checkIn->getCheckInName();
       }
     }

     return -1;
   }

   /**
    * get securityCheck Name By Id
    *
    * @param int $checkInId
    *
    */
  function getSecurityCheckNameById($securityCheckId)
  {
    foreach($this->securityChecks as $securityCheck)
    {
      if( $securityCheck->getSecurityCheckId() === $securityCheckId )
      {
        return $securityCheck->getSecurityCheckName();
      }
    }

    return -1;
  }

    /**
     * get Junction Name By Id
     *
     * @param int $junctionId
     *
     */
    function getJunctionNameById($junctionId)
    {
      foreach($this->junctions as $junction)
      {
        if( $junction->getJunctionId() === $junctionId )
        {
          return $junction->getJunctionName();
        }
      }

      return -1;
    }

    /**
     * get Gate Name By Id
     *
     * @param int $gateId
     *
     */
    function getGateNameById($gateId)
    {
      foreach($this->gates as $gate)
      {
        if( $gate->getGateId() === $gateId )
        {
          return $gate->getGateName();
        }
      }

      return -1;
    }

    /**
     * get Plane Name By Id
     *
     * @param int $planeId
     *
     */
    function getPlaneNameById($planeId)
    {
      foreach($this->planes as $plane)
      {
        if( $plane->getPlaneId() === $planeId )
        {
          return $plane->getPlaneName();
        }
      }

      return -1;
    }

    /**
     * get collectionCarousel Name By Id
     *
     * @param int $collectionCarouselId
     *
     */
    function getCollectionCarouselNameById($collectionCarouselId)
    {
      foreach($this->collectionCarousels as $collectionCarousel)
      {
        if( $collectionCarousel->getCollectionCarouselId() === $collectionCarouselId )
        {
          return $collectionCarousel->getCollectionCarouselName();
        }
      }

      return -1;
    }

    /**
     * get exitGate Name By Id
     *
     * @param int $exitGateId
     *
     */
    function getExitGateNameById($exitGateId)
    {
      foreach($this->exitGates as $exitGate)
      {
        if( $exitGate->getExitGateId() === $exitGateId )
        {
          return $exitGate->getExitGateName();
        }
      }

      return -1;
    }

    /**
    * airport map is free to modify as wished.
    */

    /**
    *
    *  checkIn -> securityCheck -> Jun -> Jun -> gate -> plane
    *                               |     |       |
    *                               |     |     collectionCarousel  ->
    *                               |     |                             ->  exitGate
    *                               |     |     collectionCarousel  ->
    *                               |     |      |
    * checkIn -> securityCheck -> Jun -> Jun -> gate -> plane
    *
    */

    public function createAirportMap()                      //       airport management should manually provide the map
    {
      $airportMap = [];

      //     map checkIns to airport

      $airportMap[$this->getAirportName()] = array($this->getCheckInNameById(0)=>1, $this->getCheckInNameById(1)=>1);

      //     map securityChecks to checkIns

      $airportMap[$this->getCheckInNameById(0)] = array($this->getSecurityCheckNameById(0)=>1);
      $airportMap[$this->getCheckInNameById(1)] = array($this->getSecurityCheckNameById(1)=>1);

      //     map junctions to securityCheck

      $airportMap[$this->getSecurityCheckNameById(0)] = array($this->getJunctionNameById(0)=>1);
      $airportMap[$this->getSecurityCheckNameById(1)] = array($this->getJunctionNameById(1)=>1);

      //     map junctions, gates to junctions

      $airportMap[$this->getJunctionNameById(0)] = array($this->getJunctionNameById(1)=>1, $this->getJunctionNameById(2)=>1);
      $airportMap[$this->getJunctionNameById(1)] = array($this->getJunctionNameById(0)=>1, $this->getJunctionNameById(3)=>1);
      $airportMap[$this->getJunctionNameById(2)] = array($this->getJunctionNameById(3)=>1, $this->getGateNameById(0)=>1);
      $airportMap[$this->getJunctionNameById(3)] = array($this->getJunctionNameById(2)=>1, $this->getGateNameById(1)=>1);


      //   map planes,collectionCarousel to gates

      $airportMap[$this->getGateNameById(0)] = array($this->getPlaneNameById(0)=>1, $this->getCollectionCarouselNameById(0)=>1);
      $airportMap[$this->getGateNameById(1)] = array($this->getPlaneNameById(1)=>1, $this->getCollectionCarouselNameById(1)=>1);


      //   map collectionCarousel to gates

      $airportMap[$this->getCollectionCarouselNameById(0)] = array($this->getExitGateNameById(0)=>1);
      $airportMap[$this->getCollectionCarouselNameById(1)] = array($this->getExitGateNameById(0)=>1);

      // map planes to nothing

      $airportMap[$this->getPlaneNameById(0)] = array();
      $airportMap[$this->getPlaneNameById(1)] = array();

      // map exitGates to nothing

      $airportMap[$this->getExitGateNameById(0)] = array();
      $airportMap[$this->getExitGateNameById(1)] = array();

      return $airportMap;
    }

    /**
     * Get the value of Airport Id
     *
     * @return mixed
     */
    public function getAirportId()
    {
        return $this->airportId;
    }

    /**
     * Set the value of Airport Id
     *
     * @param mixed $airportId
     *
     * @return self
     */
    public function setAirportId($airportId)
    {
        $this->airportId = $airportId;

        return $this;
    }

    /**
     * Get the value of Airport Name
     *
     * @return mixed
     */
    public function getAirportName()
    {
        return $this->airportName;
    }

    /**
     * Set the value of Airport Name
     *
     * @param mixed $airportName
     *
     * @return self
     */
    public function setAirportName($airportName)
    {
        $this->airportName = $airportName;

        return $this;
    }

    /**
     * Get the value of Check Ins
     *
     * @return mixed
     */
    public function getCheckIns()
    {
        return $this->checkIns;
    }

    /**
     * Set the value of Check Ins
     *
     * @param mixed $checkIns
     *
     * @return self
     */
    public function setCheckIns($checkIns)
    {
        $this->checkIns = $checkIns;

        return $this;
    }

    /**
     * Get the value of Security Checks
     *
     * @return mixed
     */
    public function getSecurityChecks()
    {
        return $this->securityChecks;
    }

    /**
     * Set the value of Security Checks
     *
     * @param mixed $securityChecks
     *
     * @return self
     */
    public function setSecurityChecks($securityChecks)
    {
        $this->securityChecks = $securityChecks;

        return $this;
    }

    /**
     * Get the value of Junctions
     *
     * @return mixed
     */
    public function getJunctions()
    {
        return $this->junctions;
    }

    /**
     * Set the value of Junctions
     *
     * @param mixed $junctions
     *
     * @return self
     */
    public function setJunctions($junctions)
    {
        $this->junctions = $junctions;

        return $this;
    }

    /**
     * Get the value of Gate
     *
     * @return mixed
     */
    public function getGates()
    {
        return $this->gates;
    }

    /**
     * Set the value of Gate
     *
     * @param mixed $gate
     *
     * @return self
     */
    public function setGates($gates)
    {
        $this->gates = $gates;

        return $this;
    }

    /**
     * Get the value of Collection Carousels
     *
     * @return mixed
     */
    public function getCollectionCarousels()
    {
        return $this->collectionCarousels;
    }

    /**
     * Set the value of Collection Carousels
     *
     * @param mixed $collectionCarousels
     *
     * @return self
     */
    public function setCollectionCarousels($collectionCarousels)
    {
        $this->collectionCarousels = $collectionCarousels;

        return $this;
    }

    /**
     * Get the value of Exit Gates
     *
     * @return mixed
     */
    public function getExitGates()
    {
        return $this->exitGates;
    }

    /**
     * Set the value of Exit Gates
     *
     * @param mixed $exitGates
     *
     * @return self
     */
    public function setExitGates($exitGates)
    {
        $this->exitGates = $exitGates;

        return $this;
    }

    /**
     * Get the value of Planes
     *
     * @return mixed
     */
    public function getPlanes()
    {
        return $this->planes;
    }

    /**
     * Set the value of Planes
     *
     * @param mixed $planes
     *
     * @return self
     */
    public function setPlanes($planes)
    {
        $this->planes = $planes;

        return $this;
    }

    /**
     * Get the value of Rfid Tags
     *
     * @return mixed
     */
    public function getRfidTags()
    {
        return $this->rfidTags;
    }

    /**
     * Set the value of Rfid Tags
     *
     * @param mixed $rfidTags
     *
     * @return self
     */
    public function setRfidTags($rfidTags)
    {
        $this->rfidTags[] = $rfidTags;

        return $this;
    }


    /**
     * Get the value of Airport Map
     *
     * @return mixed
     */
    public function getAirportMap()
    {
        return $this->airportMap;
    }

    /**
     * Set the value of Airport Map
     *
     * @param mixed $airportMap
     *
     * @return self
     */
    public function setAirportMap($airportMap)
    {
        $this->airportMap = $airportMap;

        return $this;
    }


    /**
     * Get the value of Tickets
     *
     * @return mixed
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Set the value of Tickets
     *
     * @param mixed $ticket
     *
     * @return self
     */
    public function setTickets($ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }

}

?>
