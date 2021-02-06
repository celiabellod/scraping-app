<?php


class HistoricModel
{
    private $db;

    public function __construct()
    {
        $connexion = new Connexionbdd;
        $this->db = $connexion->getdb();
    }

    public function add(Historic $historic)
    {  
        $query = "INSERT INTO `historic` (date, extraction_id) VALUES (:date, :extraction_id);";
        $req = $this->db->prepare($query);
        $arrayValue = [
            ":date" => $historic->getDate(),
            ":extraction_id" => $historic->getExtraction_id()
        ];

        if($req->execute($arrayValue)){
            $reqId = $this->db->query('SELECT LAST_INSERT_ID() FROM historic');
            $historicId = $reqId->fetch(PDO::FETCH_ASSOC);
            return $this->getOneHistoric($historicId["LAST_INSERT_ID()"]);
        } else {
            return "error";
        }
        $req->closeCursor();
    }


    public function getOneHistoric($id)
    {
        $query = "SELECT * FROM historic WHERE id = :id";

        $req = $this->db->prepare($query);

        $arrayValue = [
            ":id" => $id,
        ];

        $req->execute($arrayValue);

        $datas = $req->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($datas)){
            $extraction = new Historic($datas);
            return $extraction;
        } else {
            return "error";
        }
        $req->closeCursor();
    }
}