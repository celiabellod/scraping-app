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
     * Insertion d'un enregistrement suivant un tableau de données
     * @param Model $model Objet à créer
     * @return bool
     */
    public function create(Model $model)
    {

        $champs = [];
        $inter = [];
        $valeurs = [];

        foreach($model as $champ => $valeur){
            if($valeur !== null && $champ != 'db' && $champ != 'table'){
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }

        // On transforme le tableau "champs" en une chaine de caractères
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        // On exécute la requête
        return $this->requete('INSERT INTO '.$this->table.' ('. $liste_champs.')VALUES('.$liste_inter.')', $valeurs);
    }


     /**
     * Mise à jour d'un enregistrement suivant un tableau de données
     * @param int $id id de l'enregistrement à modifier
     * @param Model $model Objet à modifier
     * @return bool
     */
    public function update(int $id, Model $model)
    {
        $champs = [];
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach($model as $champ => $valeur){
            // UPDATE annonces SET titre = ?, description = ?, actif = ? WHERE id= ?
            if($valeur !== null && $champ != 'db' && $champ != 'table'){
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $id;

        // On transforme le tableau "champs" en une chaine de caractères
        $liste_champs = implode(', ', $champs);

        // On exécute la requête
        return $this->requete('UPDATE '.$this->table.' SET '. $liste_champs.' WHERE id = ?', $valeurs);
    }


    /**
     * Sélection d'un enregistrement suivant son id
     * @param int $id id de l'enregistrement
     * @return array Tableau contenant l'enregistrement trouvé
     */
    public function find(int $id)
    {
        // On exécute la requête
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }


    /**
     * Sélection de plusieurs enregistrements suivant un tableau de critères
     * @param array $criteres Tableau de critères
     * @return array Tableau des enregistrements trouvés
     */
    public function findBy(array $criteres)
    {
        $champs = [];
        $valeurs = [];

        // On boucle pour "éclater le tableau"
        foreach($criteres as $champ => $valeur){
            $champs[] = "$champ = ?";
            $valeurs[]= $valeur;
        }

        // On transforme le tableau en chaîne de caractères séparée par des AND
        $liste_champs = implode(' AND ', $champs);

        // On exécute la requête
        return $this->requete("SELECT * FROM {$this->table} WHERE $liste_champs", $valeurs)->fetchAll();
    }


    /**
     * Sélection de tous les enregistrements d'une table
     * @return array Tableau des enregistrements trouvés
     */
    public function findAll()
    {
        $query = $this->requete('SELECT * FROM '.$this->table);
        return $query->fetchAll();
    }


    /**
     * Suppression d'un enregistrement
     * @param int $id id de l'enregistrement à supprimer
     * @return bool 
     */
    public function delete(int $id){
        return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    /**
     * Méthode qui exécutera les requêtes
     * @param string $sql Requête SQL à exécuter
     * @param array $attributes Attributs à ajouter à la requête 
     * @return PDOStatement|false 
     */
    public function requete(string $sql, array $attributs = null)
    {
        $this->db = Db::getInstance();
        // On vérifie si on a des attributs
        if($attributs !== null){
            // Requête préparée
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        }else{
            // Requête simple
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
            `extraction_id` INT NOT NULL,
            `historic_id` INT NOT NULL ,     
            CONSTRAINT fk_result_extraction_id FOREIGN KEY(`extraction_id`) REFERENCES extraction(`id`)
            ON UPDATE CASCADE ON DELETE CASCADE,
            CONSTRAINT fk_result_historic_id FOREIGN KEY(`historic_id`) REFERENCES historic(`id`)
            ON UPDATE CASCADE ON DELETE CASCADE,
            PRIMARY KEY (`id`)) ENGINE = InnoDB;
          )";
          $this->requete($query);
      }



}