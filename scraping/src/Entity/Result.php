<?php

namespace App\src\Entity;

use App\src\Model\Model;

class Result extends Model
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
   * @var Extraction
   */
  private $extraction;
  
  /**
   * @var Historic
   */
  private $historic;


  public function __construct()
  {
      $this->table = 'result';
  }
  
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
   * Get the value of extraction
   *
   * @return  Extraction
   */ 
  public function getExtraction()
  {
    return $this->extraction;
  }

  /**
   * Set the value of extraction
   *
   * @param  Extraction  $extraction
   *
   * @return  self
   */ 
  public function setExtraction(Extraction $extraction)
  {
    $this->extraction = $extraction;

    return $this;
  }

  /**
   * Get the value of historic
   *
   * @return  Historic
   */ 
  public function getHistoric()
  {
    return $this->historic;
  }

  /**
   * Set the value of historic
   *
   * @param  Historic  $historic
   *
   * @return  self
   */ 
  public function setHistoric(Historic $historic)
  {
    $this->historic = $historic;

    return $this;
  }
}