<?php

require __DIR__.'/Autoloader.php';
Autoloader::register();
$routing = new Routes();

// Routes
$routing->initRoute("home", "", 'UserController', "logIn");
$routing->initRoute("login", "login", 'UserController', "logIn");
$routing->initRoute("signup", "signup", 'UserController', "signup");
$routing->initRoute("new-extraction", "new-extraction", 'ExtractionController', "createExtraction");
$routing->initRoute("dashboard", "dashboard", 'ExtractionController', "showAll");
$routing->initRoute("extraction", "extraction", 'ExtractionController', "showOne");


$url =  $_GET['p'];
$routeController = $routing->getControlleur($url);

if ($routing->isError404()) {
    header("HTTP/1.0 404 Not Found");
}

$controller = new $routeController[0];
$method = [$controller, $routeController[1]];
if(is_callable($method, false, $callable_name)){
    call_user_func($method);
}