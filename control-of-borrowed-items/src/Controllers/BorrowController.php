<?php

namespace Will\Borrowed\Controllers;

use Will\Borrowed\Dao\BorrowDao;
use Will\Borrowed\Dao\ItemDao;
use Will\Borrowed\Model\Borrow;
use Will\Borrowed\Model\Item;

class BorrowController
{
    public function create($description, $price, $userName, $type, $expectedDate): void
    {
        $pdo = new \PDO("mysql:dbname=control_of_borrowed_items;host=localhost", "root", "");

        $notProvideAllDatas = !($description && $userName && $type && $expectedDate);

        if($notProvideAllDatas){
            header("Location: create.php");
            exit;
        }

        $itemDao = new ItemDao($pdo);
        $item = new Item($description, floatval($price));
        $itemDao->create($item);

        $borrowDao = new BorrowDao($pdo);
        $borrow = new Borrow($item->id(), $userName, $type, $expectedDate);
        $borrowDao->create($borrow);
    }
}