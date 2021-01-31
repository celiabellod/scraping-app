<?php


abstract class AbstractController 
{
    public $twig;

    public function __construct(){
        $loader = new \Twig\Loader\FilesystemLoader('src/Templates/');
        $this->twig = new \Twig\Environment($loader);
        $function = new \Twig\TwigFunction('assets', function ($uri) {
            return (isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http').'://'.$_SERVER['SERVER_NAME'].(isset($_SERVER['SERVER_PORT']) ? ':'.$_SERVER['SERVER_PORT'] : '').str_replace('index.php', '', $_SERVER['SCRIPT_NAME']).'assets/'.$uri;
        });
        $this->twig->addFunction($function);
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