<?php
namespace App\src\Controller;

use App\src\config\Twig;
use App\src\Entity\User;
use App\src\Services\FormValidator;

abstract class AbstractController extends FormValidator
{
    /**
     * @var Twig
     */
    protected $twig;

     /**
     * @var User
     */
    protected $user;

    public function __construct()
    {
       $twig = new Twig();
       $this->twig = $twig->getTwig();

       if(isset($_SESSION['user'])){
            $manager = new User();
            $user = $manager->find($_SESSION['user']);
            $user = $manager->hydrate($user);
            $this->user = $user;
        }
    }
}