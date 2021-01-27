<?php
    
class Autoloader {
    
    public static function register() {
        spl_autoload_register(function ($class) {

            $root = $_SERVER['DOCUMENT_ROOT'].'src/';

            $directorys = [
                'Entity/',
                'Controller/',
                'Model/',
                'Services/',
                'Vue/'
            ];
    
            foreach($directorys as $directory) {
                if(file_exists($root.$directory.$class . '.php')) {
                    require_once($root.$directory.$class . '.php');
                    return;
                }           
            }
        });
    }
}

