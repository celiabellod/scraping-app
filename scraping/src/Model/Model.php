<?php
namespace App\src\Model;

use App\src\Model\Db;

class Model extends Db
{

    private $db;

    protected $table;

    
    public function hydrate(array $datas) 
    {
        foreach ($datas as $key => $value){
          $method = 'set'.ucfirst($key);
              
          if (method_exists($this, $method)) {
            $this->$method($value);
          }
        }
        return $this;
    }

     /**
     * @param Model $model Objet
     * @return bool
     */
    public function create(Model $model)
    {

        $champs = [];
        $inter = [];
        $valeurs = [];
        foreach($model as $champ => $valeur){
            if($valeur !== null && $champ != 'db' && $champ != 'table'){
                if(is_object($valeur)){
                    $champ = $champ.'_id';
                    $valeur = $valeur->getID();
                }
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);
        return $this->requete('INSERT INTO '.$this->table.' ('. $liste_champs.')VALUES('.$liste_inter.')', $valeurs);
    }


     /**
     * @param int $id id
     * @param Model $model Objet
     * @return bool
     */
    public function update(int $id, Model $model)
    {
        $champs = [];
        $valeurs = [];

        foreach($model as $champ => $valeur){
            if($valeur !== null && $champ != 'db' && $champ != 'table'){
                if(is_object($valeur)){
                    $champ = $champ.'_id';
                    $valeur = $valeur->getID();
                }
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $id;
        $liste_champs = implode(', ', $champs);
        return $this->requete('UPDATE '.$this->table.' SET '. $liste_champs.' WHERE id = ?', $valeurs);
    }


    /**
     * @param int $id id
     * @return array
     */
    public function find(int $id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }


    /**
     * @param int $id id
     * @return array
     */
    public function findLast()
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id = LAST_INSERT_ID()")->fetch();
    }


    /**
     * @param array $attributs
     * @return array
     */
    public function findBy(array $attributs)
    {
        $champs = [];
        $valeurs = [];
        foreach($attributs as $champ => $valeur){
            $champs[] = "$champ = ?";
            $valeurs[]= $valeur;
        }
        $liste_champs = implode(' AND ', $champs);

        return $this->requete("SELECT * FROM {$this->table} WHERE $liste_champs ORDER BY id DESC", $valeurs)->fetchAll();
    }


    /**
     * @return array
     */
    public function findAll()
    {
        $query = $this->requete('SELECT * FROM '.$this->table);
        return $query->fetchAll();
    }


    /**
     * @param int $id id
     * @return bool 
     */
    public function delete(int $id){
        return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }


    public function deleteAllHistoric($extractionId)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE extraction_id= ?", [$extractionId]);
    }

    /**
     * @param string $sql
     * @param array $attributs
     * @return query
     */
    public function requete(string $sql, array $attributs = null)
    {
        $this->db = Db::getInstance();
        if($attributs !== null){
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        }else{
            return $this->db->query($sql);
        }
    }

    public function createTable() {

        $query= "CREATE TABLE IF NOT EXISTS `user` (
          `id` INT NOT NULL AUTO_INCREMENT ,
          `uuid` VARCHAR(50) NOT NULL default (uuid()),
          `firstname` VARCHAR(50) NOT NULL ,
          `lastname` VARCHAR(50) NOT NULL ,
          `email` VARCHAR(50) NOT NULL ,
          `password` VARCHAR(255) NOT NULL ,
          `emailVerif` BOOLEAN NOT NULL default 0,
          PRIMARY KEY (`id`)) ENGINE = InnoDB;
          )";
          $this->requete($query);
      
      
          $query= "CREATE TABLE IF NOT EXISTS `extraction` (
            `id` INT NOT NULL AUTO_INCREMENT ,
            `url` VARCHAR(255) NOT NULL ,
            `name` VARCHAR(100) NOT NULL ,
            `type` VARCHAR(100) NOT NULL ,
            `periodicity` VARCHAR(100) NOT NULL ,
            `category` VARCHAR(100) NOT NULL , 
            `primaryContainer` VARCHAR(100) NOT NULL ,
            `secondaryContainer` VARCHAR(100),
            `user_id` INT NOT NULL,
            CONSTRAINT fk_user_id FOREIGN KEY(`user_id`) REFERENCES user(`id`)
            ON UPDATE CASCADE ON DELETE CASCADE,
            PRIMARY KEY (`id`)) ENGINE = InnoDB;
          )";
          $this->requete($query);
      
          $query= "CREATE TABLE IF NOT EXISTS `historic` (
            `id` INT NOT NULL AUTO_INCREMENT ,
            `date` DATE NOT NULL ,
            `extraction_id` INT NOT NULL,   
            CONSTRAINT fk_historic_extraction_id FOREIGN KEY(`extraction_id`) REFERENCES extraction(`id`)
            ON UPDATE CASCADE ON DELETE CASCADE,
            PRIMARY KEY (`id`)) ENGINE = InnoDB;
          )";
          $this->requete($query);
      
          $query= "CREATE TABLE IF NOT EXISTS `datas` (
            `id` INT NOT NULL AUTO_INCREMENT ,
            `dataType` VARCHAR(100) NOT NULL ,
            `dataPath` VARCHAR(255) NOT NULL ,
            `dataName` VARCHAR(100) NOT NULL ,
            `extraction_id` INT NOT NULL,   
            CONSTRAINT fk_datas_extraction_id FOREIGN KEY(`extraction_id`) REFERENCES extraction(`id`)
            ON UPDATE CASCADE ON DELETE CASCADE,
            PRIMARY KEY (`id`)) ENGINE = InnoDB;
          )";
          $this->requete($query);
      
          $query= "CREATE TABLE IF NOT EXISTS `result` (
            `id` INT NOT NULL AUTO_INCREMENT ,
            `data` TEXT NOT NULL ,
            `datas_id` INT NOT NULL,
            `historic_id` INT NOT NULL ,     
            CONSTRAINT fk_result_extraction_id FOREIGN KEY(`datas_id`) REFERENCES datas(`id`)
            ON UPDATE CASCADE ON DELETE CASCADE,
            CONSTRAINT fk_result_historic_id FOREIGN KEY(`historic_id`) REFERENCES historic(`id`)
            ON UPDATE CASCADE ON DELETE CASCADE,
            PRIMARY KEY (`id`)) ENGINE = InnoDB;
          )";
          $this->requete($query);
      }



}