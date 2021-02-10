<?php

class UserModel 
{
    private $db;

    public function __construct(){
        $connexion = new Connexionbdd;
        $this->db = $connexion->getdb();
    }


    public function createUser(User $user) 
    {
        $req = $this->db->query("SELECT email FROM user");
        $req->execute();

        //test email si elle nexite pas
        // test password  double
        while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
          if($datas['email'] == $user->getEmail()){
            return 'Votre email existe déjà, merci de vous connecter';
          }
        }
        $req->closeCursor();

        $query = "INSERT INTO user (`uuid`,`firstname`, `lastname`, `email`, `password`) VALUES (uuid(), :firstname, :lastname, :email, :password)";
        $req = $this->db->prepare($query);

        $options = [
            'cost' => 12,
        ];
        $password = password_hash($user->getPassword(), PASSWORD_BCRYPT, $options);

        $arrayValue = [
            ':firstname' => $user->getFirstname(),
            ':lastname' => $user->getLastname(),
            ':password' => $password,
            ':email' => $user->getEmail()       
        ];

        //password hash

        if($req->execute($arrayValue)){
            $user = $this->getUser($user->getEmail());
            return $user;
        } else {
            return "Une erreur est survenu dans la création de votre compte, merci de recommencer.";
        }
        
        $req->closeCursor();
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
        //password hash
        if(!empty($datas) && $password == $datas['password']){
            $user = new User($datas);
            return $user;
        } else {
            return "error";
        }
        $req->closeCursor();
    }

    public function getUser($email) 
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