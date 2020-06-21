<?php

  class plane
  {
    public $planeId;
    public $planeName;
    public $rfids;
    public $route;

    function createPlanes($totalPlanes)
    {
      $planes = [];

      for($x=0; $x<$totalPlanes; $x++)
      {
        $plane = new plane();

        $plane->setPlaneId($x);
        $plane->setPlaneName("plane_".(string)$x."_".generateRandomString(5));
        $plane->setRoute(false);

        array_push($planes, $plane);
      }

      return $planes;

    }

    /**
     * Get the value of Plane Id
     *
     * @return mixed
     */
    public function getPlaneId()
    {
        return $this->planeId;
    }

    /**
     * Set the value of Plane Id
     *
     * @param mixed $planeId
     *
     * @return self
     */
    public function setPlaneId($planeId)
    {
        $this->planeId = $planeId;

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
        $this->route[] = $route;

        return $this;
    }


    /**
     * Get the value of Plane Name
     *
     * @return mixed
     */
    public function getPlaneName()
    {
        return $this->planeName;
    }

    /**
     * Set the value of Plane Name
     *
     * @param mixed $planeName
     *
     * @return self
     */
    public function setPlaneName($planeName)
    {
        $this->planeName = $planeName;

        return $this;
    }

}

 ?>
