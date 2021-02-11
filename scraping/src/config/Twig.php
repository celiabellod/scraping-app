<?php
namespace App\src\config;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\TwigFunction;
class Twig{

    /**
     * @var Twig 
     */
    public $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('src/Templates/');
        $this->twig = new Environment($loader);
        $function = new TwigFunction('assets', function ($uri) {
            return (isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http').'://'.$_SERVER['SERVER_NAME'].(isset($_SERVER['SERVER_PORT']) ? ':'.$_SERVER['SERVER_PORT'] : '').str_replace('index.php', '', $_SERVER['SCRIPT_NAME']).'assets/'.$uri;
        });
        $this->twig->addFunction($function);
    }

}