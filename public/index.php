<?php
require '../vendor/autoload.php';
require '../helpers.php';
use Framework\Router;

// 如果需要，可以启用自动加载器
// spl_autoload_register(function($class){
//    $path = basePath('Framework/'.$class.'.php');
//    if(file_exists($path)){
//        require $path;
//    }
// });

$router = new Router();
$routes = require basePath('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 获取当前请求的方法
$method = $_SERVER['REQUEST_METHOD'];

// 传递 $uri 和 $method 给 route 方法
$router->route($uri, $method);
