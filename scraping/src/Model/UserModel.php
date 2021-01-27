<?php
require $_SERVER['DOCUMENT_ROOT'].'src/Autoloader.php';
Autoloader::register();

$connexion = new UserModel;

class UserModel 
{
    private $user;
    private $db;

    public function __construct(){
        $this->user = new User;

        $connexion = new Connexionbdd;
        $this->db = $connexion->getdb();
    }

}