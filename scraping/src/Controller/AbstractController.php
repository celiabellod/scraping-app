<?php


abstract class AbstractController 
{
    public $twig;

    public function __construct()
    {
       $twig = new Twig();
       $this->twig = $twig->twig;
    }

    public function verifPost($data)
    {
        if(isset($_POST[$data]) || !empty($_POST[$data])) {
            return $data;
        } else {
            return 'error';
        }
    }
}