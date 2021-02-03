<?php


class Extraction extends Datas
{

    /**
     * @var int
     */
    private $id;

    /**
    * @var String
    */
    private $url;

    /**
    * @var String
    */
    private $name;

    /**
    * @var String
    */
    private $type;

    /**
    * @var String
    */
    private $periodicity;

    /**
    * @var String
    */
    private $category;

    /**
    * @var String
    */
    private $primaryContainer;

    /**
    * @var String
    */
    private $secondaryContainer;

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
     * Set /*
     *
     * @param  int  $id  /*
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

}