<?php
session_start();
require_once 'Autoloader.php';
use App\Autoloader;
use App\src\config\Routing;

Autoloader::register();
$routing = new Routing();
require __DIR__.'/src/config/routes.php';
$params = [];

$uri = (isset($_GET) && isset($_GET['p'])) ? $_GET['p'] : '';

$routeManager = $routing->getControlleur($uri);
$controller = "App\\src\\Controller\\".$routeManager[0];
$controller = new $controller;
$method = [$controller, $routeManager[1]];
$params = $routeManager[2];
if(is_callable($method, false, $callable_name)){
    call_user_func_array($method, $params);
}