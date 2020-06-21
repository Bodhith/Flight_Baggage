<?php

  class bag
  {
    public $bagId;

    /**
     * create Bags
     *
     * @param int $totalBags
     *
     */
    public function createBags($totalBags)
    {
      $bags = [];

      for($x=0; $x<$totalBags; $x++)
      {
        $bag = new bag();

        $bag->setBagId($x);

        array_push($bags, $bag);
      }

      return $bags;

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
