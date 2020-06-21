<?php

  require_once("airport.php");

  require_once("../misc/debug.php");

  class airportSystem
  {
    public $airportSystemId;
    public $airports;
    public $airportsMap;


    /**
     * Set the value of Airports
     *
     * @param int $totalAirports
     *
     * @return self
     */
    public function createAirportSystem($totalAirports)
    {
      $this->airportSystemId = 0;
      $this->airports = airport::createAirports($totalAirports);

      $this->setAirportsMap($this->createAirportsMap());

      return $this;
    }

    /**
     * get Airport Names
     *
     * @return $airportNames
     *
     */
    public function getAirportNames()
    {
      $airportNames = [];

      foreach($this->airports as $airport)
      {
        array_push($airportNames, $airport->getAirportName());
      }

      return $airportNames;
    }

    /**
     * get Airport Id by Name
     *
     * @param $airportName
     *
     */
    public function getAirportIdByName($airportName)
    {
      foreach($this->airports as $airport)
      {
        if( $airport->getAirportName() === $airportName )
        {
          return $airport->getAirportId();
        }
      }

      return -1;
    }

    /**
     * get Airport Id By Name
     *
     * @return $airportId
     *
     */
    public function getAirportByName($airportName)
    {

      foreach($this->airports as $airport)
      {
        if( $airport->getAirportName() === $airportName )
        {
          return $airport;
        }
      }

      return -1;
    }

    function createAirportsMap()
    {
      $airportsMap = [];

      $airportNames = $this->getAirportNames();

      foreach($this->airports as $airport)
      {
          $airportsMap = array_merge($airportsMap, $airport->getAirportMap());
      }

      //      map planes from one aiport to other airport

      $airportsMap[$this->airports[0]->getPlaneNameById(0)] = array($this->airports[1]->getGateNameById(0)=>1);
      $airportsMap[$this->airports[0]->getPlaneNameById(1)] = array($this->airports[1]->getGateNameById(1)=>1);
      $airportsMap[$this->airports[1]->getPlaneNameById(0)] = array($this->airports[0]->getGateNameById(0)=>1);
      $airportsMap[$this->airports[1]->getPlaneNameById(1)] = array($this->airports[0]->getGateNameById(1)=>1);


      //    No need to Change, map airport names to exitGates to enable path finding algo to reach other airpot using just airport names

      foreach($this->airports as $airport)
      {
          foreach($airport->getExitGates() as $exitGate)
          {
              $airportsMap[$exitGate->getExitGateName()] = array_diff($airportNames, array($airport->getAirportName()) ) ;
          }
      }

      return $airportsMap;
    }

    /**
     * Get the value of Airport System Id
     *
     * @return mixed
     */
    public function getAirportSystemId()
    {
        return $this->airportSystemId;
    }

    /**
     * Set the value of Airport System Id
     *
     * @param mixed $airportSystemId
     *
     * @return self
     */
    public function setAirportSystemId($airportSystemId)
    {
        $this->airportSystemId = $airportSystemId;

        return $this;
    }

    /**
     * Get the value of Airports
     *
     * @return mixed
     */
    public function getAirports()
    {
        return $this->airports;
    }

    /**
     * Set the value of Airports
     *
     * @param mixed $airports
     *
     * @return self
     */
    public function setAirports($airports)
    {
        $this->airports = $airports;

        return $this;
    }

    /**
     * Get the value of Airports Map
     *
     * @return mixed
     */
    public function getAirportsMap()
    {
        return $this->airportsMap;
    }

    /**
     * Set the value of Airports Map
     *
     * @param mixed $airportsMap
     *
     * @return self
     */
    public function setAirportsMap($airportsMap)
    {
        $this->airportsMap = $airportsMap;

        return $this;
    }

}

 ?>
