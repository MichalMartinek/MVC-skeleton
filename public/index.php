<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
mb_internal_encoding("UTF-8");
$GLOBALS['url'] = "/";

spl_autoload_register(function ($class){
    if (preg_match('/Controller$/', $class))
        $adress = "../app/controller/" . $class . ".php";
    else {
        $adress = "../app/model/" . $class . ".php";
    }
    if(file_exists($adress))
        require($adress);

});
$router = new RouterController();
$router->index(array($_SERVER['REQUEST_URI']));
$router->show();
