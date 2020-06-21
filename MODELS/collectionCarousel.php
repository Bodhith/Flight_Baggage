<?php

  require_once("rfidScanner.php");

  class collectionCarousel
  {
    public $collectionCarouselId;
    public $collectionCarouselName;
    public $rfidScanners;
    public $rfids;
    public $pickedRfids;


    /**
     * Set the value of Rfids
     *
     * @param int $totalCollectionCarousels
     *
     * @param int $totalCollectionCarouselsScanners
     */
    public function createCollectionCarousels($totalCollectionCarousels, $totalCollectionCarouselsScanners)
    {
      $collectionCarousels = [];

      for($x=0; $x<$totalCollectionCarousels; $x++)
      {
        $collectionCarouselsScanners = [];

        for($y=0; $y<$totalCollectionCarouselsScanners; $y++)
        {
          $collectionCarouselsScanner = new rfidScanner();

          $collectionCarouselsScanner->setRfidScannerId($y);

          array_push($collectionCarouselsScanners, $collectionCarouselsScanner);
        }

        $collectionCarousel = new collectionCarousel();

        $collectionCarousel->setCollectionCarouselId($x);
        $collectionCarousel->setCollectionCarouselName("collectionCarousel_".(string)$x."_".generateRandomString(5));
        $collectionCarousel->setRfidScanners($collectionCarouselsScanners);

        array_push($collectionCarousels, $collectionCarousel);
      }

      return $collectionCarousels;

    }

    /**
     * Get the value of Collection Carousel Id
     *
     * @return mixed
     */
    public function getCollectionCarouselId()
    {
        return $this->collectionCarouselId;
    }

    /**
     * Set the value of Collection Carousel Id
     *
     * @param mixed $collectionCarouselId
     *
     * @return self
     */
    public function setCollectionCarouselId($collectionCarouselId)
    {
        $this->collectionCarouselId = $collectionCarouselId;

        return $this;
    }

    /**
     * Get the value of Rfid Scanners
     *
     * @return mixed
     */
    public function getRfidScanners()
    {
        return $this->rfidScanners;
    }

    /**
     * Set the value of Rfid Scanners
     *
     * @param mixed $rfidScanners
     *
     * @return self
     */
    public function setRfidScanners($rfidScanners)
    {
        $this->rfidScanners = $rfidScanners;

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
     * Get the value of Collection Carousel Name
     *
     * @return mixed
     */
    public function getCollectionCarouselName()
    {
        return $this->collectionCarouselName;
    }

    /**
     * Set the value of Collection Carousel Name
     *
     * @param mixed $collectionCarouselName
     *
     * @return self
     */
    public function setCollectionCarouselName($collectionCarouselName)
    {
        $this->collectionCarouselName = $collectionCarouselName;

        return $this;
    }


    /**
     * Get the value of Picked Rfids
     *
     * @return mixed
     */
    public function getPickedRfids()
    {
        return $this->pickedRfids;
    }

    /**
     * Set the value of Picked Rfids
     *
     * @param mixed $pickedRfids
     *
     * @return self
     */
    public function setPickedRfids($pickedRfids)
    {
        $this->pickedRfids[] = $pickedRfids;

        return $this;
    }

}

 ?>
