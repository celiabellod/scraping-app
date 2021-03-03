<?php
session_start();
require __DIR__.'/vendor/autoload.php';

use App\Config\Routing;

$routing = new Routing();
$params = [];

$uri = (isset($_GET) && isset($_GET['p'])) ? $_GET['p'] : '';

$routeManager = $routing->getControlleur($uri);
$controller = "App\\Controller\\".$routeManager[0];
$controller = new $controller;
$method = [$controller, $routeManager[1]];
$params = $routeManager[2];
if(is_callable($method, false, $callable_name)){
    call_user_func_array($method, $params);
}