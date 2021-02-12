<?php

namespace App\src\Entity;

use App\src\Model\Model;

class Result extends Model
{

  /**
   * @var int
   */
  protected $id;

  /**
   * @var String
   */
  protected $data;
  
  /**
   * @var Historic
   */
  protected $historic;

  /**
   * @var Datas
   */
  protected $datas;


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

  /**
   * Get the value of datas
   *
   * @return  Datas
   */ 
  public function getDatas()
  {
    return $this->datas;
  }

  /**
   * Set the value of datas
   *
   * @param  Datas  $datas
   *
   * @return  self
   */ 
  public function setDatas(Datas $datas)
  {
    $this->datas = $datas;

    return $this;
  }
}