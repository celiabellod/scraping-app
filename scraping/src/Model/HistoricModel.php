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
            $query = $this->db->query("SELECT * FROM historic WHERE id = LAST_INSERT_ID()");
            $query->execute();
            $datas = $query->fetch(PDO::FETCH_ASSOC);

            if(!empty($datas)){
                $historic = new Historic($datas);
                return $historic;
            } else {
                return "error";
            }
            $req->closeCursor();
            
        } else {
            return "error";
        }
        $req->closeCursor();
    }

    public function getListHistoric($id)
    {
        $historic = [];
        $query = "SELECT * FROM historic WHERE extraction_id = :extraction_id ORDER BY id DESC";
        $req = $this->db->prepare($query);

        $arrayValue = [
            ":extraction_id" => $id,
        ];

        $req->execute($arrayValue);

        while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
            $historic[] = new Historic($datas);
        }
        return $historic;
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
            $historic = new Historic($datas);
            return $historic;
        } else {
            return "error";
        }
        $req->closeCursor();
    }

    public function deleteOneHistoric($historicId)
    {
        $query = "DELETE FROM historic WHERE id = :id;";
        $req = $this->db->prepare($query);

        $arrayValue = [
            ":id" => $historicId,
        ];

        if($req->execute($arrayValue)){
            return 1;
        } else {
            return 'error';
        }
        $req->closeCursor();
    }

    public function deleteAllHistoric($extractionId)
    {
        $query = "DELETE FROM historic WHERE extraction_id = :extraction_id;";
        $req = $this->db->prepare($query);

        $arrayValue = [
            ":extraction_id" => $extractionId,
        ];

        if($req->execute($arrayValue)){
            return 1;
        } else {
            return 'error';
        }
        $req->closeCursor();
    }

}