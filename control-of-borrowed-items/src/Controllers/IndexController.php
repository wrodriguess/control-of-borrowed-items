<?php

namespace Will\Borrowed\Controllers;

use Will\Borrowed\Dao\BorrowDao;

class IndexController
{
    public function index(): array
    {
        $pdo = new \PDO("mysql:dbname=control_of_borrowed_items;host=localhost", "root", "");

        $borrowDao = new BorrowDao($pdo);
        // return $borrowDao->findAll();

        $loader = new \Twig\Loader\FilesystemLoader('../templates/base.html.twig');
        $twig = new \Twig\Environment($loader, ['debug' => true]);
        
        echo $template = $twig->load('../templates/base.html.twig');
    }
}