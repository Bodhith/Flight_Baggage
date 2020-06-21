<?php

  class log
  {
    public $logId;
    public $user;
    public $rfid;
    public $route;
    public $timestamp;


    /**
     * Get the value of Log Id
     *
     * @return mixed
     */
    public function getLogId()
    {
        return $this->logId;
    }

    /**
     * Set the value of Log Id
     *
     * @param mixed $logId
     *
     * @return self
     */
    public function setLogId($logId)
    {
        $this->logId = $logId;

        return $this;
    }

    /**
     * Get the value of User
     *
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of User
     *
     * @param mixed $user
     *
     * @return self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of Bags
     *
     * @return mixed
     */
    public function getRfid()
    {
        return $this->rfid;
    }

    /**
     * Set the value of Bags
     *
     * @param mixed $userId, $bags, $rfid
     *
     * @return self
     */
    public function setRfid($rfid, $bagId)
    {
        $this->rfid[$rfid] = $bagId;

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
     * @param mixed $rfid, $route
     *
     * @return self
     */
    public function setRoute($rfid, $route)
    {
        $this->route[$rfid] = $route;

        return $this;
    }


    /**
     * Get the value of Timestamp
     *
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set the value of Timestamp
     *
     * @param mixed $route, $timestamp
     *
     * @return self
     */
    public function setTimestamp($bagRfid, $route, $timestamp)
    {
        $this->timestamp[$bagRfid][$route] = $timestamp;

        return $this;
    }

}

 ?>
