<?php

  class rfidTag
  {
    public $rfidTagId;
    public $rfid;
    public $bagId;

    /**
     * Get the value of Rfid Tag Id
     *
     * @return mixed
     */
    public function getRfidTagId()
    {
        return $this->rfidTagId;
    }

    /**
     * Set the value of Rfid Tag Id
     *
     * @param mixed $rfidTagId
     *
     * @return self
     */
    public function setRfidTagId($rfidTagId)
    {
        $this->rfidTagId = $rfidTagId;

        return $this;
    }

    /**
     * Get the value of Rfid
     *
     * @return mixed
     */
    public function getRfid()
    {
        return $this->rfid;
    }

    /**
     * Set the value of Rfid
     *
     * @param mixed $rfid
     *
     * @return self
     */
    public function setRfid($rfid)
    {
        $this->rfid = $rfid;

        return $this;
    }

    /**
     * Get the value of Bag Id
     *
     * @return mixed
     */
    public function getBagId()
    {
        return $this->bagId;
    }

    /**
     * Set the value of Bag Id
     *
     * @param mixed $bagId
     *
     * @return self
     */
    public function setBagId($bagId)
    {
        $this->bagId = $bagId;

        return $this;
    }

}

 ?>
