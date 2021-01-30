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
    `id` INT NOT NULL AUTO_INCREMENT ,
    `firstname` VARCHAR(50) NOT NULL ,
    `lastname` VARCHAR(50) NOT NULL ,
    `email` VARCHAR(50) NOT NULL ,
    `password` VARCHAR(255) NOT NULL , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB;
    )";
    $this->db->query($query);


    $query= "CREATE TABLE IF NOT EXISTS `extraction` (
      `id` INT NOT NULL AUTO_INCREMENT ,
      `url` VARCHAR(255) NOT NULL ,
      `name` VARCHAR(100) NOT NULL ,
      `type` VARCHAR(100) NOT NULL ,
      `periodicity` VARCHAR(100) NOT NULL ,
      `category` VARCHAR(100) NOT NULL , 
      `primaryContainer` VARCHAR(100) NOT NULL ,
      `secondaryContainer` VARCHAR(100),
      /*`user_id` INT,
      CONSTRAINT fk_user_id FOREIGN KEY(`user_id`) REFERENCES user(`id`)
      ON UPDATE CASCADE ON DELETE CASCADE,*/
      PRIMARY KEY (`id`)) ENGINE = InnoDB;
    )";
    $this->db->query($query);

    $query= "CREATE TABLE IF NOT EXISTS `historic` (
      `id` INT NOT NULL AUTO_INCREMENT ,
      `date` DATE NOT NULL ,
      /*`extraction_id` INT,   
      CONSTRAINT fk_historic_extraction_id FOREIGN KEY(`extraction_id`) REFERENCES extraction(`id`)
      ON UPDATE CASCADE ON DELETE CASCADE,*/
      PRIMARY KEY (`id`)) ENGINE = InnoDB;
    )";
    $this->db->query($query);

    $query= "CREATE TABLE IF NOT EXISTS `datas` (
      `id` INT NOT NULL AUTO_INCREMENT ,
      `dataType` VARCHAR(100) NOT NULL ,
      `dataPath` VARCHAR(255) NOT NULL ,
      `dataName` VARCHAR(100) NOT NULL ,
      /*`extraction_id` INT,
      `historic_id` INT,      
      CONSTRAINT fk_datas_extraction_id FOREIGN KEY(`extraction_id`) REFERENCES extraction(`id`)
      ON UPDATE CASCADE ON DELETE CASCADE,
      CONSTRAINT fk_datas_historic_id FOREIGN KEY(`historic_id`) REFERENCES historic(`id`)
      ON UPDATE CASCADE ON DELETE CASCADE,*/
      PRIMARY KEY (`id`)) ENGINE = InnoDB;
    )";
    $this->db->query($query);

    $query= "CREATE TABLE IF NOT EXISTS `result` (
      `id` INT NOT NULL AUTO_INCREMENT ,
      `data` TEXT NOT NULL ,
      /*`extraction_id` INT,
      `historic_id` INT,      
      CONSTRAINT fk_datas_extraction_id FOREIGN KEY(`extraction_id`) REFERENCES extraction(`id`)
      ON UPDATE CASCADE ON DELETE CASCADE,
      CONSTRAINT fk_datas_historic_id FOREIGN KEY(`historic_id`) REFERENCES historic(`id`)
      ON UPDATE CASCADE ON DELETE CASCADE,*/
      PRIMARY KEY (`id`)) ENGINE = InnoDB;
    )";
    $this->db->query($query);
  }

  public function getdb() {
    $db = $this->db;
    return $db;
  }

}