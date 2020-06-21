<?php

  class rfidScanner
  {
    public $rfidScannerId;

    /**
     * Get the value of Rfid Scanner Id
     *
     * @return mixed
     */
    public function getRfidScannerId()
    {
        return $this->rfidScannerId;
    }

    /**
     * Set the value of Rfid Scanner Id
     *
     * @param mixed $rfidScannerId
     *
     * @return self
     */
    public function setRfidScannerId($rfidScannerId)
    {
        $this->rfidScannerId = $rfidScannerId;

        return $this;
    }

    /**
     * Get the value of Verdict
     *
     * @return mixed
     */
    public function getVerdict()
    {
        return $this->verdict;
    }

    /**
     * Set the value of Verdict
     *
     * @param mixed $verdict
     *
     * @return self
     */
    public function setVerdict($verdict)
    {
        $this->verdict = $verdict;

        return $this;
    }

}

 ?>
