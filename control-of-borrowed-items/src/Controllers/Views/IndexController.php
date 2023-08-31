<?php

namespace Will\Borrowed\Controllers\Views;

use Will\Borrowed\Dao\BorrowDao;

class IndexController
{

    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);

        $data = [
            'name' => 'William'
        ];

        return $twig->render('hello.html.twig', $data);
    }
}