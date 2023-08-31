<?php

namespace Will\Borrowed\Controllers\Views;

use Will\Borrowed\Dao\BorrowDao;
use Will\Borrowed\Dao\ItemDao;
use Will\Borrowed\Model\Borrow;
use Will\Borrowed\Model\Item;

class BorrowController
{
    private $pdo;
    private $borrowDao;
    private $itemDao;

    public function __construct(\PDO $pdo, BorrowDao $borrowDao, ItemDao $itemDao)
    {
        $this->pdo = $pdo;
        $this->borrowDao = $borrowDao;
        $this->itemDao = $itemDao;
    }

    public function index()
    {
        $borrowList = $this->borrowDao->findAll();

        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);

        $data = [
            'items' => $borrowList
        ];

        return $twig->render('/index.html.twig', $data);
    }

    public function create()
    {
        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);

        $data = [
            'name' => 'William'
        ];

        return $twig->render('create.php', $data);
    }

    public function createAction($description, $price, $userName, $type, $expectedDate): void
    {
        $notProvideAllDatas = !($description && $userName && $type && $expectedDate);

        if($notProvideAllDatas){
            header("Location: create.php");
            exit;
        }

        $item = new Item($description, floatval($price));
        $this->itemDao->create($item);

        $borrow = new Borrow($item->id(), $userName, $type, $expectedDate);
        $this->borrowDao->create($borrow);

        header("Location: /control-of-borrowed-items");
        exit();
    }
}