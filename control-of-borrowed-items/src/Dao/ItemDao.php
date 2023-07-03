<?php

namespace Will\Borrowed\Dao;

use Will\Borrowed\Model\Item;
use \PDO;

class ItemDao
{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(Item $item): void
    {
        $sql = $this->pdo->prepare("INSERT INTO item (description, price) VALUES (:description, :price)");
        $sql->bindValue(':description', $item->description());
        $sql->bindValue(':price', $item->price());
        $sql->execute();

        $id = $this->pdo->lastInsertId();
        $item->setId($id);
    }
}