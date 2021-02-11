<?php
namespace App\Model;

class UserModel extends Model
{




    // public function createUser(User $user) 
    // {
    //     $req = $this->db->query("SELECT email FROM user");
    //     $req->execute();
    //     while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
    //       if($datas['email'] == $user->getEmail()){
    //         return 'Votre email existe déjà, merci de vous connecter';
    //       }
    //     }
    //     $req->closeCursor();
    //     $query = "INSERT INTO user (`uuid`,`firstname`, `lastname`, `email`, `password`) VALUES (uuid(), :firstname, :lastname, :email, :password)";
    //     $req = $this->db->prepare($query);
    //     $password = password_hash($user->getPassword(), PASSWORD_ARGON2I);
    //     $arrayValue = [
    //         ':firstname' => $user->getFirstname(),
    //         ':lastname' => $user->getLastname(),
    //         ':password' => $password,
    //         ':email' => $user->getEmail()       
    //     ];
    //     if($req->execute($arrayValue)){
    //         $user = $this->getUser($user->getEmail());
    //         return $user;
    //     } else {
    //         return "Une erreur est survenu dans la création de votre compte, merci de recommencer.";
    //     }
        
    //     $req->closeCursor();
    // }

    // public function logInUser($email, $password, $uuid) 
    // {
    //     $query = "SELECT * FROM user WHERE email = :email";
    //     $query .= (!empty($uuid)) ? " && uuid = :uuid" : '';
        
    //     $req = $this->db->prepare($query);
    //     if(!empty($uuid)){
    //         $arrayValue = [
    //             ":email" => $email,
    //             ":uuid" => $uuid
    //         ];
    //     } else {
    //         $arrayValue = [
    //             ":email" => $email,
    //         ];
    //     }
    //     $req->execute($arrayValue);
    //     $datas = $req->fetch(PDO::FETCH_ASSOC);
    //     if(!empty($datas)){
    //         if($datas['emailVerif'] == 0){
    //             if(!empty($uuid)){
    //                 $query = $this->db->prepare("UPDATE user set uuid = uuid(), emailVerif = 1 WHERE email = :email");
    //                 $arrayValue = [
    //                     ":email" => $email,
    //                 ];
    //                 $req = $req->execute($arrayValue);
    //                 $datas = $req->fetch(PDO::FETCH_ASSOC);
    //                 if(!$req){
    //                     return 'error';
    //                 }
    //             } else {
    //                 return "error";
    //             }
    //         } 
    //         if(password_verify($password, $datas['password'])){
    //             $user = new User($datas);
    //             return $user;
    //         } else {
    //             return 'error';
    //         }
    //     } else {
    //         return "error";
    //     }
    //     $req->closeCursor();
    // }

    // public function getUser($email) 
    // {
    //     $query = "SELECT * FROM user WHERE email = :email";
    //     $req = $this->db->prepare($query);
    //     $arrayValue = [
    //         ":email" => $email,
    //     ];
    //     $req->execute($arrayValue);
    //     $datas = $req->fetch(PDO::FETCH_ASSOC);
    //     if(!empty($datas)){
    //         $user = new User($datas);
    //         return $user;
    //     } else {
    //         return "error";
    //     }
    //     $req->closeCursor();
    // }

}