<?php

  require_once("../misc/debug.php");
  require_once("../misc/routes_maps.php");
  require_once("../misc/generateRandomVals.php");

  class ticket
  {
    public $ticketId;
    public $pnr;
    public $departureTime;
    public $arrivalTime;
    public $route;

    /**
    *
     * create Ticket
     *
     */
    public function createTicket($currentAirportName, $destinationAirportName, $airportSystem)
    {
      $ticket = new ticket();

      $ticket->setPnr("pnr_".generateRandomString(7));

      $currentAirport = $airportSystem->getAirports()[$airportSystem->getAirportIdByName($currentAirportName)];

      if( is_array($currentAirport->getTickets()) )
      {
        $ticketId = sizeof($currentAirport->getTickets());
      }
      else
      {
          $ticketId = 0;
      }

      $ticket->setTicketId($ticketId);

      $route = array($currentAirportName, $destinationAirportName);

      $ticket->setRoute($route);

      $currentAirport->setTickets($ticket);

      return $ticket;

    }

    /**
     * Get the value of Ticket Id
     *
     * @return mixed
     */
    public function getTicketId()
    {
        return $this->ticketId;
    }

    /**
     * Set the value of Ticket Id
     *
     * @param mixed $ticketId
     *
     * @return self
     */
    public function setTicketId($ticketId)
    {
        $this->ticketId = $ticketId;

        return $this;
    }

    /**
     * Get the value of Pnr
     *
     * @return mixed
     */
    public function getPnr()
    {
        return $this->pnr;
    }

    /**
     * Set the value of Pnr
     *
     * @param mixed $pnr
     *
     * @return self
     */
    public function setPnr($pnr)
    {
        $this->pnr = $pnr;

        return $this;
    }

    /**
     * Get the value of Departure Time
     *
     * @return mixed
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    /**
     * Set the value of Departure Time
     *
     * @param mixed $departureTime
     *
     * @return self
     */
    public function setDepartureTime($departureTime)
    {
        $this->departureTime = $departureTime;

        return $this;
    }

    /**
     * Get the value of Arrival Time
     *
     * @return mixed
     */
    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    /**
     * Set the value of Arrival Time
     *
     * @param mixed $arrivalTime
     *
     * @return self
     */
    public function setArrivalTime($arrivalTime)
    {
        $this->arrivalTime = $arrivalTime;

        return $this;
    }

    /**
     * Get the value of Route
     *
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set the value of Route
     *
     * @param mixed $route
     *
     * @return self
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

}

 ?>
