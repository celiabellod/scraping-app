<?php


abstract class AbstractController 
{
    public $twig;

    public function __construct(){
        $loader = new \Twig\Loader\FilesystemLoader($_SERVER['DOCUMENT_ROOT'].'/src/Templates');
        $this->twig = new \Twig\Environment($loader);
    }


    public function verifPost($data){
        if(isset($_POST[$data]) || !empty($_POST[$data])) {
            return $data;
        } else {
            return 'error';
        }
    }
}