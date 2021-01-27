<?php

class Connexionbdd {
    
  private $servername = "mysql";
  private $username = "root";
  private $password = "root";
  private $dbname = "scraping";
  private $db = "";

  public function __construct(){
    try {
      $this->db = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }

    $query= "CREATE TABLE IF NOT EXISTS `user` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    `firstname` VARCHAR(50) NOT NULL ,
    `lastname` VARCHAR(50) NOT NULL ,
    `email` VARCHAR(50) NOT NULL ,
    `password` VARCHAR(255) NOT NULL , 
    
    PRIMARY KEY (`id`)) ENGINE = InnoDB;
    )";
    $this->db->query($query);

  }

  public function getdb() {
    $db = $this->db;
    return $db;
  }

}