<?php

use Will\Borrowed\Controllers;

require 'vendor/autoload.php';

define('URL_PREFIX', '/control-of-borrowed-items');

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
 $r->addRoute('GET', URL_PREFIX.'/', '/views/index.php');
 $r->addRoute('GET', URL_PREFIX.'/home', '/views/index.php');
 $r->addRoute('GET', URL_PREFIX.'/create', '/views/create.php');
 $r->addRoute('POST', URL_PREFIX.'/createAction', 'Will\Borrowed\Controllers\BorrowController::create');
 $r->addRoute('GET', URL_PREFIX.'/returnedAction/{id}', '/src/action/returnedAction.php');
 $r->addRoute('GET', URL_PREFIX.'/renderview', 'Will\Borrowed\Controllers\Views\IndexController::renderView');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
 $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
 case FastRoute\Dispatcher::NOT_FOUND:
     require "404.php";
     break;
 case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
     $allowedMethods = $routeInfo[1];
     require "405.php";
     break;
 case FastRoute\Dispatcher::FOUND:
     $handler = $routeInfo[1];
     $vars = ($httpMethod == 'POST') ? $_POST : $routeInfo[2];

     list($class, $method) = explode("::", $handler, 2);
     echo call_user_func_array(array(new $class, $method), $vars);

     break;
}
