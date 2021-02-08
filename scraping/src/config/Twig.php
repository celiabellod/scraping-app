<?php

class Twig{

    
    public $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('src/Templates/');
        $this->twig = new \Twig\Environment($loader);
        $function = new \Twig\TwigFunction('assets', function ($uri) {
            return (isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http').'://'.$_SERVER['SERVER_NAME'].(isset($_SERVER['SERVER_PORT']) ? ':'.$_SERVER['SERVER_PORT'] : '').str_replace('index.php', '', $_SERVER['SCRIPT_NAME']).'assets/'.$uri;
        });
        $this->twig->addFunction($function);

        $this->twig->addFilter( new Twig\TwigFilter( 'svgicon', array( $this, 'svgicon' ) ) );
    }

    /**
     * display svg icon from svg sprite
     * @param $icon
     * @param null $width
     * @param null $height
     * @return string
     */
    public function svgicon($icon, $width = null, $height = null) {
        if(!$height) {
            $height = $width;
        }
        return '<svg class="icon" ' . ($width ? 'width="' . $width . '"' : '') . ' ' . ($height ? 'height="' . $height . '"' : '') . '>
            <use xlink:href="../../../../assets/images/svgsprite.svg#' . $icon . '"></use>
        </svg>';
    }

}