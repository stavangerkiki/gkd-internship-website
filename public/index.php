<?php
require'../helpers.php';

$uri = $_SERVER['REQUEST_URI'];
echo "Requested URI: $uri";
require basePath('router.php');