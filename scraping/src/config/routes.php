<?php

$routing->initRoute("", 'UserController', "logIn");
$routing->initRoute("login", 'UserController', "logIn");
$routing->initRoute("signup", 'UserController', "signup");

$routing->initRoute("extraction/new", 'ExtractionController', "create");
$routing->initRoute("dashboard", 'ExtractionController', "getList");
$routing->initRoute("extraction/(\d+)", 'ExtractionController', "getOne");
$routing->initRoute("extraction/(\d+)/delete", 'ExtractionController', "delete");

$routing->initRoute("extraction/(\d+)/historic/(\d+)", 'HistoricController', "getOne");
$routing->initRoute("extraction/(\d+)/historic/(\d+)/delete", 'HistoricController', "deleteOne");
$routing->initRoute("extraction/(\d+)/historic/delete", 'HistoricController', "deleteAll");
$routing->initRoute("extraction/(\d+)/historic/new", 'HistoricController', "create");