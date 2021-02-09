<?php


$routing->initRoute("", 'UserController', "logIn");
$routing->initRoute("login", 'UserController', "logIn");
$routing->initRoute("signup", 'UserController', "signup");
$routing->initRoute("404", 'ErrorController', "error404");
$routing->initRoute("my-account", 'UserController', "update");

$routing->initRoute("extraction/new", 'ExtractionController', "create", "admin");
$routing->initRoute("dashboard", 'ExtractionController', "getList", "admin");
$routing->initRoute("extraction/(\d+)", 'ExtractionController', "getOne", "admin");
$routing->initRoute("extraction/(\d+)/delete", 'ExtractionController', "delete", "admin");
$routing->initRoute("extraction/(\d+)/update", 'ExtractionController', "update", "admin");

$routing->initRoute("extraction/(\d+)/historic/(\d+)", 'HistoricController', "getOne", "admin");
$routing->initRoute("extraction/(\d+)/historic/(\d+)/delete", 'HistoricController', "deleteOne", "admin");
$routing->initRoute("extraction/(\d+)/historic/delete", 'HistoricController', "deleteAll", "admin");
$routing->initRoute("extraction/(\d+)/historic/new", 'HistoricController', "create", "admin");
