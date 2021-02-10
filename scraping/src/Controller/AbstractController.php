<?php


abstract class AbstractController 
{
    /**
     * @var Twig
     */
    public $twig;


     /**
     * @var User
     */
    public $user;

    public function __construct()
    {
       $twig = new Twig();
       $this->twig = $twig->twig;
       if(isset($_SESSION['user'])){
            $this->user = unserialize($_SESSION['user']);
        }
    }

    public function verifPost($data)
    {
        if(isset($data) || !empty($data)) {
            return true;
        } else {
            return false;
        }
    }
}