<?php
require $_SERVER['DOCUMENT_ROOT'].'src/Autoloader.php';
Autoloader::register();

class UserController 
{

    /*
    * @var Objet
    */
    private $user;

    /*
    * @var Objet
    */
    private $userModel;

    public function __construct(){
        $this->user = new User;
        $this->userModel = new UserModel;
    }

    /*
    * @param string $email
    * @param string $password
    * @return void
    */
    public function logIn($email, $password) {

    }

    /*
    * @param string $email
    * @param string $firstname
    * @param string $lastname
    * @param string $password
    * @param string $passwordConfirm
    * @return void
    */
    public function signUp($email, $firstname, $lastname, $password, $passwordConfirm) {
        
    }

    /*
    * @param string $email
    * @return void
    */
    public function logOut($email) {
        
    }

}