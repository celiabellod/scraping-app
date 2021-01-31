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

}