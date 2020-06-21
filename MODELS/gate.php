<?php

  require_once("rfidScanner.php");

  class gate
  {
    public $gateId;
    public $gateName;
    public $rfidScanner;
    public $rfids;


    /**
     * Set the value of Rfids
     *
     * @param int $totalGates
     *
     */
    public function createGates($totalGates)
    {
      $gates = [];

      for($x=0; $x<$totalGates; $x++)
      {
        $rfidScanner = new rfidScanner();

        $rfidScanner->setRfidScannerId($x);

        $gate = new gate();

        $gate->setGateId($x);
        $gate->setGateName("gate_".(string)$x."_".generateRandomString(5));
        $gate->setRfidScanner($rfidScanner);

        array_push($gates, $gate);
      }

      return $gates;

    }

    /**
     * Get the value of Gate Id
     *
     * @return mixed
     */
    public function getGateId()
    {
        return $this->gateId;
    }

    /**
     * Set the value of Gate Id
     *
     * @param mixed $gateId
     *
     * @return self
     */
    public function setGateId($gateId)
    {
        $this->gateId = $gateId;

        return $this;
    }

    /**
     * Get the value of Rfid Scanner
     *
     * @return mixed
     */
    public function getRfidScanner()
    {
        return $this->rfidScanner;
    }

    /**
     * Set the value of Rfid Scanner
     *
     * @param mixed $rfidScanner
     *
     * @return self
     */
    public function setRfidScanner($rfidScanner)
    {
        $this->rfidScanner = $rfidScanner;

        return $this;
    }

    /**
     * Get the value of Rfids
     *
     * @return mixed
     */
    public function getRfids()
    {
        return $this->rfids;
    }

    /**
     * Set the value of Rfids
     *
     * @param mixed $rfids
     *
     * @return self
     */
    public function setRfids($rfids)
    {
        $this->rfids[] = $rfids;

        return $this;
    }

    /**
     * Get the value of Gate Name
     *
     * @return mixed
     */
    public function getGateName()
    {
        return $this->gateName;
    }

    /**
     * Set the value of Gate Name
     *
     * @param mixed $gateName
     *
     * @return self
     */
    public function setGateName($gateName)
    {
        $this->gateName = $gateName;

        return $this;
    }

}

 ?>
