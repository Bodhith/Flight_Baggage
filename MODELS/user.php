<?php


  require_once("ticket.php");
  require_once("bag.php");

  require_once("../misc/generateRandomVals.php");

  class user
  {
    public $id;
    public $name;
    public $mobile;
    public $ticket;
    public $bags;

    /**
     * Set the value of Bags Ids
     *
     * @param mixed $totalUsers
     *
     */
    function createUsers($userDetails, $airportSystem)
    {
        require_once("../headers/userCreationMacros.php");

      $users = [];

      $totalUsers = $userDetails[totalUsers];

      for($x=0; $x<$totalUsers; $x++)
      {
        $user = new user();

        $user->setId($x);
        $user->setName($userDetails[username][$x]);
        $user->setMobile($userDetails[userMobile][$x]);
        $user->setTicket(ticket::createTicket($userDetails[userRoute][$x][0], $userDetails[userRoute][$x][1], $airportSystem));
        $user->setBags(bag::createBags($userDetails[userBags][$x]));

        array_push($users, $user);
      }

      return $users;

    }

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name
     *
     * @param mixed $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of Mobile
     *
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set the value of Mobile
     *
     * @param mixed $mobile
     *
     * @return self
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get the value of Ticket
     *
     * @return mixed
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * Set the value of Ticket
     *
     * @param mixed $ticket
     *
     * @return self
     */
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get the value of Bags
     *
     * @return mixed
     */
    public function getBags()
    {
        return $this->bags;
    }

    /**
     * Set the value of Bags
     *
     * @param mixed $bags
     *
     * @return self
     */
    public function setBags($bags)
    {
        $this->bags = $bags;

        return $this;
    }

}

 ?>
