<?php


abstract class Datas extends AbstractModel
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var String
     */
    private $dataName;

    /**
     * @var String
     */
    private $dataType;


    /**
     * @var String
     */
    private $dataPath;


    /**
     * Get the value of id
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
     * Get the value of dataName
     *
     * @return  String
     */ 
    public function getDataName()
    {
        return $this->dataName;
    }

    /**
     * Set the value of dataName
     *
     * @param  String  $dataName
     *
     * @return  self
     */ 
    public function setDataName(String $dataName)
    {
        $this->dataName = $dataName;

        return $this;
    }

    /**
     * Get the value of dataType
     *
     * @return  String
     */ 
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * Set the value of dataType
     *
     * @param  String  $dataType
     *
     * @return  self
     */ 
    public function setDataType(String $dataType)
    {
        $this->dataType = $dataType;

        return $this;
    }

    /**
     * Get the value of dataPath
     *
     * @return  String
     */ 
    public function getDataPath()
    {
        return $this->dataPath;
    }

    /**
     * Set the value of dataPath
     *
     * @param  String  $dataPath
     *
     * @return  self
     */ 
    public function setDataPath(String $dataPath)
    {
        $this->dataPath = $dataPath;

        return $this;
    }
}