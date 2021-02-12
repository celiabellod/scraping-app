<?php

namespace App\src\Entity;

use App\src\Model\Model;

class Historic extends Model
{

    /**
    * @var int
    */
    private $id;

    /**
    * @var Date
    */
    private $date;

    /**
   * @var Extraction
   */
    private $extraction;

    public function __construct()
    {
        $this->table = 'historic';
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
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
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
        $this->date =  new \DateTime('NOW');
        $this->date = $this->date->format('Y-m-d H:i');
        return $this->date;
    }

  


    /**
     * Get the value of extraction
     *
     * @return  Extraction
     */ 
    public function getExtraction()
    {
        return $this->extraction;
    }

    /**
     * Set the value of extraction
     *
     * @param  Extraction  $extraction
     *
     * @return  self
     */ 
    public function setExtraction(Extraction $extraction)
    {
        $this->extraction = $extraction;

        return $this;
    }
}