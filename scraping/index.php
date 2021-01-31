<?php

require __DIR__.'/Autoloader.php';
Autoloader::register();
$routing = new Routes();
$params = [];

// Routes
$routing->initRoute("", 'UserController', "logIn");
$routing->initRoute("login", 'UserController', "logIn");
$routing->initRoute("signup", 'UserController', "signup");
$routing->initRoute("new-extraction", 'ExtractionController', "createExtraction");
$routing->initRoute("dashboard", 'ExtractionController', "showAll");
$routing->initRoute("extraction", 'ExtractionController', "showOne");
$routing->initRoute("single", 'ResultController', "showAll");
$routing->initRoute("extraction/(\d+)", 'ExtractionController', "showOne");


$uri = (isset($_GET) && isset($_GET['p'])) ? $_GET['p'] : '';

$routeManager = $routing->getControlleur($uri);

if ($routing->isError404()) {
    header("HTTP/1.0 404 Not Found");
}

$controller = new $routeManager[0];
$method = [$controller, $routeManager[1]];
$params[] = $routeManager[2];

if(is_callable($method, false, $callable_name)){
    call_user_func_array($method, $params);
}