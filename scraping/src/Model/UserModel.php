<?php

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