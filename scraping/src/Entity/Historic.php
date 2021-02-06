<?php


class Historic
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
   * @var int
   */
    private $extraction_id;
    

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
        $this->date = $this->setDate();
    }
  
  
    public function hydrate(array $datas) 
    {
        foreach ($datas as $key => $value){
          $method = 'set'.ucfirst($key);
              
          if (method_exists($this, $method)) {
            $this->$method($value);
          }
        }
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
        $this->date =  new DateTime('NOW');
        $this->date = $this->date->format('Y-m-d H:i');
        return $this->date;
    }

    /**
     * Get the value of extraction_id
     *
     * @return  int
     */ 
    public function getExtraction_id()
    {
        return $this->extraction_id;
    }

    /**
     * Set the value of extraction_id
     *
     * @param  int  $extraction_id
     *
     * @return  self
     */ 
    public function setExtraction_id(int $extraction_id)
    {
        $this->extraction_id = $extraction_id;

        return $this;
    }
}