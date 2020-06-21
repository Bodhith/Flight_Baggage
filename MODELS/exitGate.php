<?php

  require_once("rfidScanner.php");

  class exitGate
  {
    public $exitGateId;
    public $exitGateName;
    public $rfidScanner;
    public $rfids;
    public $alert;

    /**
     * Set the value of Rfids
     *
     * @param int $totalExitGates
     *
     */
    public function createExitGates($totalExitGates)
    {
      $exitGates = [];

      for($x=0; $x<$totalExitGates; $x++)
      {
        $rfidScanner = new rfidScanner();

        $rfidScanner->setRfidScannerId($x);

        $exitGate = new exitGate();

        $exitGate->setExitGateId($x);
        $exitGate->setExitGateName("exitGate".(string)$x."_".generateRandomString(5));
        $exitGate->setRfidScanner($rfidScanner);
        $exitGate->setAlert(false);

        array_push($exitGates, $exitGate);
      }

      return $exitGates;

    }

    /**
     * Get the value of Exit Gate Id
     *
     * @return mixed
     */
    public function getExitGateId()
    {
        return $this->exitGateId;
    }

    /**
     * Set the value of Exit Gate Id
     *
     * @param mixed $exitGateId
     *
     * @return self
     */
    public function setExitGateId($exitGateId)
    {
        $this->exitGateId = $exitGateId;

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
     * Get the value of Alert
     *
     * @return mixed
     */
    public function getAlert()
    {
        return $this->alert;
    }

    /**
     * Set the value of Alert
     *
     * @param mixed $alert
     *
     * @return self
     */
    public function setAlert($alert)
    {
        $this->alert = $alert;

        return $this;
    }


    /**
     * Get the value of Exit Gate Name
     *
     * @return mixed
     */
    public function getExitGateName()
    {
        return $this->exitGateName;
    }

    /**
     * Set the value of Exit Gate Name
     *
     * @param mixed $exitGateName
     *
     * @return self
     */
    public function setExitGateName($exitGateName)
    {
        $this->exitGateName = $exitGateName;

        return $this;
    }

}

 ?>
