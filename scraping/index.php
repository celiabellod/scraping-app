<?php
$args = [];

require $_SERVER['DOCUMENT_ROOT'].'Autoloader.php';
Autoloader::register();

$routing = new Routes();

// Routes
$routing->initRoute("login", "/login", 'UserController', "logIn");
$routing->initRoute("signup", "/signup", 'UserController', "signup");

$url = $_SERVER['REQUEST_URI'];

$routeController = $routing->getControlleur($url);

if ($routing->isError404()) {
    header("HTTP/1.0 404 Not Found");
}
$args = ['email', 'password', $routeController[2]];

$controller = new $routeController[0];
$method = [$controller, $routeController[1]];
if(is_callable($method, false, $callable_name)){
    call_user_func_array($method, $args);
}

