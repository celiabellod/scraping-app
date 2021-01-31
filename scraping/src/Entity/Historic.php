<?php


class Historic 
{

    /*
    * @var int
    */
    private $id;

    /*
    * @var Date
    */
    private $date;


    public function __construct()
    {
        $this->date = $this->setDate();
    }


    /**
     * Get /*
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Get /*
     *
     * @return  Date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set /*
     *
     * @param  Date  $date  /*
     *
     * @return  self
     */ 
    public function setDate()
    {
        $this->date = new DateTime();

        return $this;
    }
}