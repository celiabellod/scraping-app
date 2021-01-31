<?php


$routing->initRoute("", 'UserController', "logIn");
$routing->initRoute("login", 'UserController', "logIn");
$routing->initRoute("signup", 'UserController', "signup");
$routing->initRoute("new-extraction", 'ExtractionController', "createExtraction");
$routing->initRoute("dashboard", 'ExtractionController', "showAll");
$routing->initRoute("extraction", 'ExtractionController', "showOne");
$routing->initRoute("single", 'ResultController', "showAll");
$routing->initRoute("extraction/(\d+)", 'ExtractionController', "showOne");