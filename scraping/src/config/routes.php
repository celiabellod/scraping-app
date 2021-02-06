<?php

$routing->initRoute("", 'UserController', "logIn");
$routing->initRoute("login", 'UserController', "logIn");
$routing->initRoute("signup", 'UserController', "signup");

$routing->initRoute("extraction/new", 'ExtractionController', "create");
$routing->initRoute("dashboard", 'ExtractionController', "getList");
$routing->initRoute("extraction/(\d+)", 'ExtractionController', "getOne");
$routing->initRoute("extraction/(\d+)/result/(\d+)", 'HistoricController', "getOne");
$routing->initRoute("extraction/(\d+)/result/new", 'HistoricController', "create");