<?php

class ExtractionModel
{
    private $db;

    public function __construct(){
        $connexion = new Connexionbdd;
        $this->db = $connexion->getdb();
    }

    public function getListExtraction()
    {
      $extractions = [];
  
      $query = $this->db->query('SELECT * FROM extraction ORDER BY id DESC');
  
      while ($datas = $query->fetch(PDO::FETCH_ASSOC)) {
        $extractions[] = new Extraction($datas);
      }
  
      return $extractions;
    }

    public function add(Extraction $extraction){

        $query = "INSERT INTO `extraction`(`url`, `name`,`dataType`, `periodicity`, `category`, `primaryContainer`, `secondaryContainer`) 
                    VALUES (:url, :name, :dataType, :periodicity, :category, :primaryContainer, :secondaryContainer)";

        $req = $this->db->prepare($query);
    
        $arrayValue = [
            ":url" => $extraction->getUrl(),
            ":name"  => $extraction->getName(),
            ":dataType"  => $extraction->getDataType(),
            ":periodicity"  => $extraction->getPeriodicity(),
            ":category" => $extraction->getCategory(),
            ":primaryContainer" => $extraction->getPrimaryContainer(),
            ":secondaryContainer" => $extraction->getSecondaryContainer(),
        ];
    
        if($req->execute($arrayValue)){
            return 1;
        } else {
            return "error";
        }
    
        $req->closeCursor();
          
    }

    public function update(Extraction $extraction)
    {
    
        $query = $this->_db->prepare('UPDATE extraction SET url = :url, name = :name, dataType = :dataType, periodicity = :periodicity, 
                                    category = :category, primaryContainer = :primaryContainer, secondaryContainer = :secondaryContainer  
                                    WHERE id = :id');

        $req = $this->db->prepare($query);
   
        $arrayValue = [
            ":url" => $extraction->getUrl(),
            ":name"  => $extraction->getName(),
            ":dataType"  => $extraction->getDataType(),
            ":periodicity"  => $extraction->getPeriodicity(),
            ":category" => $extraction->getCategory(),
            ":primaryContainer" => $extraction->getPrimaryContainer(),
            ":secondaryContainer" => $extraction->getSecondaryContainer(),
            ":id" => $extraction->getid(),
        ];

        if($req->execute($arrayValue)){
            return 1;
        } else {
            return "error";
        }
    
        $req->closeCursor();
    }



}