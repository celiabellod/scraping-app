<?php

class ResultModel extends AbstractModel{

    public function add(Result $result)
    {
        $query = "INSERT INTO `result` (data, extraction_id, historic_id) VALUES (:data, :extraction_id, :historic_id);";
        $req = $this->db->prepare($query);
        $arrayValue = [
            ":data" => $result->getData(),
            ":extraction_id" => $result->getExtraction(),
            ":historic_id" => $result->getHistoric()
        ];
        if($req->execute($arrayValue)){
            return 1;
        } else {
            return "error";
        }
        $req->closeCursor();
    }

    public function getListResult(Historic $historic)
    {
      $results = [];
      $query = 'SELECT * FROM result WHERE historic_id = :historic_id';
      $req = $this->db->prepare($query);

      $arrayValue = [
          ":historic_id" => $historic->getId(),
      ];
      $req->execute($arrayValue);
      while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
        $results[] = new Result($datas);
      }
      return $results;
    }

}