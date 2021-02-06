<?php


class Result extends AbstractEntity
{

  /**
   * @var int
   */
  private $id;

  /**
   * @var String
   */
  private $data;

   /**
   * @var int
   */
  private $extraction_id;
  
  /**
   * @var int
   */
  private $historic_id;

  /**
   * Get /*
   *
   * @return  id
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

  /**
   * Get the value of historic_id
   *
   * @return  int
   */ 
  public function getHistoric_id()
  {
    return $this->historic_id;
  }

  /**
   * Set the value of historic_id
   *
   * @param  int  $historic_id
   *
   * @return  self
   */ 
  public function setHistoric_id(int $historic_id)
  {
    $this->historic_id = $historic_id;

    return $this;
  }
}