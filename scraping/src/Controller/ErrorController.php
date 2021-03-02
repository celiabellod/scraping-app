<?php
namespace App\Controller;

use App\Controller\AbstractController;

class ErrorController extends AbstractController{

    public function error404() {
        echo $this->twig->render('404.html.twig');
    }
}