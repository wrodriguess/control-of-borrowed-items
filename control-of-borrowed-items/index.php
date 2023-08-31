<?php

use Will\Borrowed\Controllers;
use Will\Borrowed\Dao\BorrowDao;
use Will\Borrowed\Dao\ItemDao;

require 'vendor/autoload.php';

define('URL_PREFIX', '/control-of-borrowed-items');

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', URL_PREFIX.'/teste', 'Will\Borrowed\Controllers\Views\IndexController::index');

    // CREATE EMPRESTIMO
    $r->addRoute('GET', URL_PREFIX.'/create', 'Will\Borrowed\Controllers\Views\BorrowController::create');
    $r->addRoute('POST', URL_PREFIX.'/createAction', 'Will\Borrowed\Controllers\Views\BorrowController::createAction');

    // READ EMPRESTIMO
    $r->addRoute('GET', URL_PREFIX.'/', 'Will\Borrowed\Controllers\Views\BorrowController::index');

    // DONE EMPRESTIMO
    $r->addRoute('GET', URL_PREFIX.'/returnedAction/{id}', '/config/returnLoan.php');
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

        if($handler === "/config/returnLoan.php"){
            require __DIR__ . '/config/returnLoan.php';
        }

        list($class, $method) = explode("::", $handler, 2);

        $pdo = new \PDO("mysql:dbname=control_of_borrowed_items;host=localhost", "root", "");
        $borrowDao = new BorrowDao($pdo);
        $itemDao = new ItemDao($pdo);

        echo call_user_func_array(
            array(
                new $class($pdo, $borrowDao, $itemDao),
                $method
            ),
            $vars
        );

        break;
}