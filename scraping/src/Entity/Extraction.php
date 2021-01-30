<?php


class Extraction extends Datas {

    /*
    * @var string
    */
    private $id;

    /*
    * @var string
    */
    private $url;

    /*
    * @var string
    */
    private $name;

    /*
    * @var string
    */
    private $dataType;

    /*
    * @var string
    */
    private $periodicity;

    /*
    * @var string
    */
    private $category;

    /*
    * @var string
    */
    private $primaryContainer;

    /*
    * @var string
    */
    private $secondaryContainer;

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

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set /*
     *
     * @param  string  $url  /*
     *
     * @return  self
     */ 
    public function setUrl(string $url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set /*
     *
     * @param  string  $name  /*
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * Set /*
     *
     * @param  string  $dataType  /*
     *
     * @return  self
     */ 
    public function setDataType(string $dataType)
    {
        $this->dataType = $dataType;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getPeriodicity()
    {
        return $this->periodicity;
    }

    /**
     * Set /*
     *
     * @param  string  $periodicity  /*
     *
     * @return  self
     */ 
    public function setPeriodicity(string $periodicity)
    {
        $this->periodicity = $periodicity;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set /*
     *
     * @param  string  $category  /*
     *
     * @return  self
     */ 
    public function setCategory(string $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getPrimaryContainer()
    {
        return $this->primaryContainer;
    }

    /**
     * Set /*
     *
     * @param  string  $primaryContainer  /*
     *
     * @return  self
     */ 
    public function setPrimaryContainer(string $primaryContainer)
    {
        $this->primaryContainer = $primaryContainer;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getSecondaryContainer()
    {
        return $this->secondaryContainer;
    }

    /**
     * Set /*
     *
     * @param  string  $secondaryContainer  /*
     *
     * @return  self
     */ 
    public function setSecondaryContainer(string $secondaryContainer)
    {
        $this->secondaryContainer = $secondaryContainer;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set /*
     *
     * @param  string  $id  /*
     *
     * @return  self
     */ 
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }
}