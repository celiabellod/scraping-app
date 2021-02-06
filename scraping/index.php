<?php

require __DIR__.'/Autoloader.php';
Autoloader::register();

$routing = new Routing();
require __DIR__.'/src/config/routes.php';

$params = [];

$uri = (isset($_GET) && isset($_GET['p'])) ? $_GET['p'] : '';

$routeManager = $routing->getControlleur($uri);

$controller = new $routeManager[0];
$method = [$controller, $routeManager[1]];
$params[] = $routeManager[2];

if(is_callable($method, false, $callable_name)){
    call_user_func_array($method, $params);
}