<?php

namespace App\Model;

use PDO;
use PDOException;

class Db extends PDO{
    
  private static $instance;

  private const DBHOST = 'mysql';
  private const DBUSER = 'root';
  private const DBPASS = 'root';
  private const DBNAME = 'scraping';

  public function __construct()
  {
    $db = 'mysql:dbname='. self::DBNAME . ';host=' . self::DBHOST;

      try{
        parent::__construct($db, self::DBUSER, self::DBPASS);

        $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      }catch(PDOException $e){
        die($e->getMessage());
      }

  }

  public static function getInstance():self
  {
      if(self::$instance === null){
          self::$instance = new self();
      }
      return self::$instance;
  }


}