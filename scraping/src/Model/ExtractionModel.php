<?php

class ExtractionModel
{
    private $db;

    public function __construct()
    {
        $connexion = new Connexionbdd;
        $this->db = $connexion->getdb();
    }

    /**
     * @param Extraction $extraction
     * @param Array $datas
     */
    public function add(Extraction $extraction, Array $datas)
    {
        $query = "INSERT INTO extraction
                    (`url`, `name`, `type`, `periodicity`, `category` ,`primaryContainer`,`secondaryContainer`) 
                    VALUES (:url, :name, :type, :periodicity, :category, :primaryContainer, :secondaryContainer);
                ";
                
        $req = $this->db->prepare($query);
    
        $arrayValue = [
            ":url" => $extraction->getUrl(),
            ":name"  => $extraction->getName(),
            ":type"  => $extraction->getType(),
            ":periodicity"  => $extraction->getPeriodicity(),
            ":category" => $extraction->getCategory(),
            ":primaryContainer" => $extraction->getPrimaryContainer(),
            ":secondaryContainer" => $extraction->getSecondaryContainer(),
        ];
    
        if($req->execute($arrayValue)){
            $req->closeCursor();

            $reqId = $this->db->query('SELECT LAST_INSERT_ID() FROM extraction');
            $extractionId = $reqId->fetch(PDO::FETCH_ASSOC);

            foreach($datas as $data){
                $query = "INSERT INTO `datas`(`dataType`, `dataPath`,`dataName`, `extraction_id`) VALUES (:dataType, :dataPath, :dataName, :extraction_id);";
                $req = $this->db->prepare($query);
                $arrayValue = [
                    ":dataType" => $data->getDataType(),
                    ":dataName"  => $data->getDataName(),
                    ":dataPath"  => $data->getDataPath(),
                    ":extraction_id" => $extractionId["LAST_INSERT_ID()"]
                ];
                
                if($req->execute($arrayValue)){
                    return 1;
                } else {
                    return 'error';
                }
                $reqId->closeCursor();
            }
        } else {
            return "error";
        }
        $req->closeCursor();
          
    }

    public function update(Extraction $extraction)
    {
    
    
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
        $datasQuery = "SELECT * FROM datas WHERE extraction_id = :id;";

        $datasReq = $this->db->prepare($datasQuery);

        $extractionQuery = "SELECT * FROM extraction WHERE id = :id";

        $extractionReq = $this->db->prepare($extractionQuery);

        $arrayValue = [
            ":id" => $id,
        ];
        $datasReq->execute($arrayValue);
        $extractionReq->execute($arrayValue);

        $extractionDatas = $extractionReq->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($extractionDatas)){
            while ($datas = $datasReq->fetch(PDO::FETCH_ASSOC)) {
                $extractionDatas['datas'][] = new Datas($datas);
            }
            $extraction = new Extraction($extractionDatas);
            return $extraction;
        } else {
            return "error";
        }
        $datasReq->closeCursor();
        $extractionReq->closeCursor();
    }

    public function deleteExtraction($id)
    {
        $query = "DELETE FROM extraction WHERE id = :id;";
        $req = $this->db->prepare($query);

        $arrayValue = [
            ":id" => $id,
        ];

        if($req->execute($arrayValue)){
            return 1;
        } else {
            return 'error';
        }
        $req->closeCursor();
    }




}