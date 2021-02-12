<?php
namespace App\src\Controller;

use App\src\config\Twig;

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
            $this->user = $_SESSION['user'];
        }
    }

    public function verificationField($data)
    {
        if(isset($data) && !empty($data)) {
            return true;
        } else {
            return false;
        }
    }
}