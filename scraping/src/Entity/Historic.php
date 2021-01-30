<?php


class Historic extends Datas {

    /*
    * @var Date
    */
    private $date;


    public function __construct(){
        $this->date = $this->setDate();
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