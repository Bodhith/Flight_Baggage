<?php

  require_once("rfidScanner.php");

  class securityCheck
  {
    public $securityCheckId;
    public $securityCheckName;
    public $rfidScanner;
    public $rfidsVerdicts;


    /**
     * create SecurityChecks
     *
     * @param mixed $totalGates
     *
     */
    public function createSecurityChecks($totalSecurityChecks)
    {
      $securityChecks = [];

      for($x=0; $x<$totalSecurityChecks; $x++)
      {
        $rfidScanner = new rfidScanner();

        $rfidScanner->setRfidScannerId($x);

        $securityCheck = new securityCheck();

        $securityCheck->setSecurityCheckId($x);
        $securityCheck->setSecurityCheckName("securityCheck_".(string)$x."_".generateRandomString(5));
        $securityCheck->setRfidScanner($rfidScanner);

        array_push($securityChecks, $securityCheck);
      }

      return $securityChecks;

    }

    /**
     * Get the value of Security Check Id
     *
     * @return mixed
     */
    public function getSecurityCheckId()
    {
        return $this->securityCheckId;
    }

    /**
     * Set the value of Security Check Id
     *
     * @param mixed $securityCheckId
     *
     * @return self
     */
    public function setSecurityCheckId($securityCheckId)
    {
        $this->securityCheckId = $securityCheckId;

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
     * Get the value of Security Check Name
     *
     * @return mixed
     */
    public function getSecurityCheckName()
    {
        return $this->securityCheckName;
    }

    /**
     * Set the value of Security Check Name
     *
     * @param mixed $securityCheckName
     *
     * @return self
     */
    public function setSecurityCheckName($securityCheckName)
    {
        $this->securityCheckName = $securityCheckName;

        return $this;
    }


    /**
     * Get the value of Rfids Verdicts
     *
     * @return mixed
     */
    public function getRfidsVerdicts()
    {
        return $this->rfidsVerdicts;
    }

    /**
     * Set the value of Rfids Verdicts
     *
     * @param mixed $rfidsVerdicts
     *
     * @return self
     */
    public function setRfidsVerdicts($userId, $bagId, $rfid, $verdict)
    {
        $this->rfidsVerdicts[$userId][$bagId] = array($rfid, $verdict);

        return $this;
    }

}

 ?>
