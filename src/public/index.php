<?php
include_once "inc/start.php";
require_once "vendor/autoload.php";

use core\Router;

session_start();

$uriPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = new Router();
$route->route($uriPath);