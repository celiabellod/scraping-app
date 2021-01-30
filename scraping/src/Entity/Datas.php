<?php



abstract class Datas {

    /*
    * @var string
    */
    private $dataName;

    /*
    * @var string
    */
    private $dataType;
    
    /*
    * @var string
    */
    private $dataPath;


    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getDataName()
    {
        return $this->dataName;
    }

    /**
     * Set /*
     *
     * @param  string  $dataName  /*
     *
     * @return  self
     */ 
    public function setDataName(string $dataName)
    {
        $this->dataName = $dataName;

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
    public function getDataPath()
    {
        return $this->dataPath;
    }

    /**
     * Set /*
     *
     * @param  string  $dataPath  /*
     *
     * @return  self
     */ 
    public function setDataPath(string $dataPath)
    {
        $this->dataPath = $dataPath;

        return $this;
    }
}