<?php

  require_once("rfidScanner.php");

  class junction
  {
    public $junctionId;
    public $junctionName;
    public $rfidScanner;
    public $rfids;


    /**
     * Set the value of Rfids
     *
     * @param int $totalJunctions
     *
     */
    public function createJunctions($totalJunctions)
    {
      $junctions = [];

      for($x=0; $x<$totalJunctions; $x++)
      {
        $rfidScanner = new rfidScanner();

        $rfidScanner->setRfidScannerId($x);

        $junction = new junction();

        $junction->setJunctionId($x);
        $junction->setJunctionName("junction_".(string)$x."_".generateRandomString(5));
        $junction->setRfidScanner($rfidScanner);

        array_push($junctions, $junction);
      }

      return $junctions;
    }

    /**
     * Get the value of Junction Id
     *
     * @return mixed
     */
    public function getJunctionId()
    {
        return $this->junctionId;
    }

    /**
     * Set the value of Junction Id
     *
     * @param mixed $junctionId
     *
     * @return self
     */
    public function setJunctionId($junctionId)
    {
        $this->junctionId = $junctionId;

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
     * Get the value of Junction Name
     *
     * @return mixed
     */
    public function getJunctionName()
    {
        return $this->junctionName;
    }

    /**
     * Set the value of Junction Name
     *
     * @param mixed $junctionName
     *
     * @return self
     */
    public function setJunctionName($junctionName)
    {
        $this->junctionName = $junctionName;

        return $this;
    }

}

 ?>
