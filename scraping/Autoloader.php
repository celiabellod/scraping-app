<?php
namespace App;

class Autoloader {

    static function register()
    {
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    static function autoload($class){
        require __DIR__.'/vendor/autoload.php';
        $class = str_replace(__NAMESPACE__. '\\','',$class);
        $class = str_replace('\\','/',$class); 
        if(file_exists(__DIR__ . '/' . $class . '.php')){
            require __DIR__ . '/' . $class . '.php'; 
        }
    }

    // public static function register($class) {
    //     require __DIR__.'/vendor/autoload.php';
    //     session_start();
    //     // spl_autoload_register(function ($class) {

    //     //     $root = $_SERVER['DOCUMENT_ROOT'].'src/';

    //     //     $directorys = [
    //     //         'Entity/',
    //     //         'App/Controller/',
    //     //         'Model/',
    //     //         'Services/',
    //     //         'Vue/',
    //     //         'config/'
    //     //     ];
    
    //     //     foreach($directorys as $directory) {
    //     //         if(file_exists($root.$directory.$class . '.php')) {
    //     //             require_once($root.$directory.$class . '.php');
    //     //             return;
    //     //         }           
    //     //     }
    //     // });
    // }

}

