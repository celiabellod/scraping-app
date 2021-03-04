<?php
namespace App\Controller;

use App\Config\Twig;
use App\Entity\User;
use App\Services\FormValidator;

abstract class AbstractController
{
    /**
     * @var Twig
     */
    protected $twig;

     /**
     * @var FormValidator
     */
    protected $formValidator;

    /**
     * @var User
     */
    protected $user;

    public function __construct()
    {
       $twig = new Twig();
       $this->twig = $twig->getTwig();

       $this->formValidator = new FormValidator();

       if(isset($_SESSION['user'])){
            $manager = new User();
            $user = $manager->find($_SESSION['user']);
            $user = $manager->hydrate($user);
            $this->user = $user;
        }
    }
}