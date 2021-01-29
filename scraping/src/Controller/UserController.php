<?php

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
    * @return void
    */
    public function logIn() {
        header('Location:src/Templates/pages/form/login.php');
    }

    /*
    * @param string $email
    * @param string $firstname
    * @param string $lastname
    * @param string $password
    * @param string $passwordConfirm
    * @return void
    */
    public function signup() {
        header('Location:src/Templates/pages/form/signup.php');
    }

    /*
    * @param string $email
    * @return void
    */
    public function logOut($email) {
        
    }

}