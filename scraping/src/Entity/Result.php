<?php


class Result {

      /*
    * @var string
    */
    private $data;
    

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }


    public function hydrate(array $datas) {
        foreach ($datas as $key => $value)
        {
          $method = 'set'.ucfirst($key);
              
          if (method_exists($this, $method)) {
            $this->$method($value);
          }
        }
    }

    /*

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set /*
     *
     * @param  string  $data  /*
     *
     * @return  self
     */ 
    public function setData(string $data)
    {
        $this->data = $data;

        return $this;
    }
}