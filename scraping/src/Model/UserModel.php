<?php

class UserModel 
{
    private $db;

    public function __construct(){
        $connexion = new Connexionbdd;
        $this->db = $connexion->getdb();
    }

    public function logInUser($email, $password) 
    {
        $query = "SELECT * FROM user WHERE email = :email";
        $req = $this->db->prepare($query);
        $arrayValue = [
            ":email" => $email,
        ];
        $req->execute($arrayValue);
        $datas = $req->fetch(PDO::FETCH_ASSOC);
        if(!empty($datas)){
            $user = new User($datas);
            return $user;
        } else {
            return "error";
        }
        $req->closeCursor();
    }

}