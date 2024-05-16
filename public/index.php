<?php
session_start();
require '../vendor/autoload.php';
require '../helpers.php';
use Framework\Router;


$router = new Router();
$routes = require basePath('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 获取当前请求的方法
$method = $_SERVER['REQUEST_METHOD'];

// 传递 $uri 和 $method 给 route 方法
$router->route($uri, $method);
