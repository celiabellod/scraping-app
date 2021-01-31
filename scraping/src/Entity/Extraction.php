<?php


class Extraction 
{

    /*
    * @var int
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
    private $type;

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

     /*
    * @var array
    */
    private $dataName = [];

    /*
    * @var array
    */
    private $dataType = [];
    
    /*
    * @var array
    */
    private $dataPath = [];

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }


    public function hydrate(array $datas) 
    {
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
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set /*
     *
     * @param  string  $type  /*
     *
     * @return  self
     */ 
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  array
     */ 
    public function getDataName()
    {
        return $this->dataName;
    }

    /**
     * Set /*
     *
     * @param  array  $dataName  /*
     *
     * @return  self
     */ 
    public function setDataName(array $dataName)
    {
        $this->dataName = $dataName;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  array
     */ 
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * Set /*
     *
     * @param  array  $dataType  /*
     *
     * @return  self
     */ 
    public function setDataType(array $dataType)
    {
        $this->dataType = $dataType;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  array
     */ 
    public function getDataPath()
    {
        return $this->dataPath;
    }

    /**
     * Set /*
     *
     * @param  array  $dataPath  /*
     *
     * @return  self
     */ 
    public function setDataPath(array $dataPath)
    {
        $this->dataPath = $dataPath;

        return $this;
    }
}