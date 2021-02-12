<?php
namespace App\src\Controller;

use App\src\Controller\AbstractController;

class ErrorController extends AbstractController{

    public function error404() {
        echo $this->twig->render('404.html.twig');
    }
}