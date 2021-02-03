<?php


class Result extends AbstractModel
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
}