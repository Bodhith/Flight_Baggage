<?php

  require_once("rfidTag.php");
  require_once("rfidScanner.php");

  class checkIn
  {
    public $checkInId;
    public $checkInName;
    public $rfidScanner;
    public $rfids;

    /**
    * @param int $totalCheckIns
    */
    public function createCheckIns($totalCheckIns)
    {
      $checkIns = [];

      for($x=0; $x<$totalCheckIns; $x++)
      {
          $rfidScanner = new rfidScanner();

          $rfidScanner->setRfidScannerId($x);

          $checkIn = new checkIn();

          $checkIn->setCheckInId($x);
          $checkIn->setCheckInName("checkIn_".(string)$x."_".generateRandomString(5));
          $checkIn->setRfidScanner($rfidScanner);

          array_push($checkIns, $checkIn);
      }

      return $checkIns;
    }

    /**
    * Attach the RFID tags to Bags
    */
    public function attachTagToBag($user, $airport)
    {
      $attachedRfids = [];

      $this->rfidScanner->setVerdict(true);

      if( is_array($airport->getRfidTags()) )
      {
        $rfidTagId = sizeof($airport->getRfidTags());
      }
      else
      {
        $rfidTagId = 0;
      }

      foreach($user->getBags() as $bag)
      {
        $rfidTag = new rfidTag();

        $rfidTag->setRfidTagId($rfidTagId++);
        $rfidTag->setRfid("tag_".generateRandomString(5));
        $rfidTag->setBagId($bag->getBagId());

        $this->setRfids($rfidTag->getRfid());

        $attachedRfids[$bag->getBagId()] = $rfidTag->getRfid();

        $airport->setRfidTags($rfidTag);
      }

      return $attachedRfids;
    }

    /**
     * Get the value of Check In Id
     *
     * @return mixed
     */
    public function getCheckInId()
    {
        return $this->checkInId;
    }

    /**
     * Set the value of Check In Id
     *
     * @param mixed $checkInId
     *
     * @return self
     */
    public function setCheckInId($checkInId)
    {
        $this->checkInId = $checkInId;

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
     * Get the value of Check In Name
     *
     * @return mixed
     */
    public function getCheckInName()
    {
        return $this->checkInName;
    }

    /**
     * Set the value of Check In Name
     *
     * @param mixed $checkInName
     *
     * @return self
     */
    public function setCheckInName($checkInName)
    {
        $this->checkInName = $checkInName;

        return $this;
    }

}

 ?>
