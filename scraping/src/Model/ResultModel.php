<?php


class ResultModel {

    private $db;

    public function __construct(){
        $connexion = new Connexionbdd;
        $this->db = $connexion->getdb();
    }


    public function add(Result $result) {
        $query = "INSERT INTO `result` (`data`) VALUES (:data);";

        $req = $this->db->prepare($query);

        $arrayValue = [":data" => $result->getData()];

        if($req->execute($arrayValue)){
            return 1;
        } else {
            return "error";
        }
    
        $req->closeCursor();
    }

    public function getListResult(){

      $results = [];
  
      $query = $this->db->query('SELECT * FROM result ORDER BY id DESC');
  
      while ($datas = $query->fetch(PDO::FETCH_ASSOC)) {
        $results[] = new Result($datas);
      }
  
      return $results;
    }

}