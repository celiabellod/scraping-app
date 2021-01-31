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


    public function getOneExtraction($id)
    {
        
        $query = "SELECT * FROM extraction WHERE id = :id";
        $req = $this->db->prepare($query);
        $arrayValue = [
            ":id" => $id,
        ];
        $req->execute($arrayValue);

        $datas = $req->fetch(PDO::FETCH_ASSOC);

        if(!empty($datas)){
            $extraction = new Extraction($datas);
            return $extraction;
        } else {
            return "error";
        }
    
        $req->closeCursor();
    }

    public function add(Extraction $extraction){

        $query = "INSERT INTO `extraction`
                    (`url`, `name`,`type`, `periodicity`, `category`, `primaryContainer`, `secondaryContainer`) 
                    VALUES (:url, :name, :type, :periodicity, :category, :primaryContainer, :secondaryContainer);

                    INSERT INTO `datas`(`dataType`, `dataPath`,`dataName`) VALUES (:dataType, :dataPath, :dataName);
                ";
                

        $req = $this->db->prepare($query);
    
        $arrayValue = [
            ":url" => $extraction->getUrl(),
            ":name"  => $extraction->getName(),
            ":type"  => $extraction->getDataType(),
            ":periodicity"  => $extraction->getPeriodicity(),
            ":category" => $extraction->getCategory(),
            ":primaryContainer" => $extraction->getPrimaryContainer(),
            ":secondaryContainer" => $extraction->getSecondaryContainer(),
            ":dataType" => $extraction->getDataType(),
            ":dataName"  => $extraction->getDataName(),
            ":dataPath"  => $extraction->getDataPath(),
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