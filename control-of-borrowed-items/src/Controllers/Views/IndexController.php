<?php

namespace Will\Borrowed\Controllers\Views;

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

    public function renderView()
    {
        $loader = new \Twig\Loader\FilesystemLoader('views');
        $twig = new \Twig\Environment($loader, [
            'cache' => '/path/to/compilation_cache',
        ]);

        $data = [
            'name' => 'William'
        ];

        return $twig->render('hello.html.twig', $data);
    }
}