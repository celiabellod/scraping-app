<?php


$routing->initRoute("", 'UserController', "logIn");
$routing->initRoute("login", 'UserController', "logIn");
$routing->initRoute("signup", 'UserController', "signup");
$routing->initRoute("extraction/new", 'ExtractionController', "createExtraction");
$routing->initRoute("dashboard", 'ExtractionController', "showAll");
$routing->initRoute("extraction/(\d+)", 'ExtractionController', "showOne");
$routing->initRoute("extraction/(\d+)/result/(\d+)", 'ResultController', "showAll");