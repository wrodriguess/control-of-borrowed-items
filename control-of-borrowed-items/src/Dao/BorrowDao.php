<?php

namespace Will\Borrowed\Dao;

use Will\Borrowed\Model\Borrow;
use \PDO;

class BorrowDao
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(Borrow $borrow): void
    {
        $sql = $this->pdo->prepare("INSERT INTO borrow (item_id, user_name, type, expected_date) VALUES (:item_id, :user_name, :type, :expected_date)");
        $sql->bindValue(':item_id', $borrow->itemId());
        $sql->bindValue(':user_name', $borrow->userName());
        $sql->bindValue(':type', $borrow->type());
        $sql->bindValue(':expected_date', $borrow->expectedDate());
        $sql->execute();
    }

    public function findAll(): array
    {
        $array = [];

        $sql = $this->pdo->query("SELECT b.*, i.description FROM borrow AS b JOIN item AS i ON i.id = b.item_id WHERE b.effective_date IS NULL;");

        if ($sql->rowCount() > 0) {
            $borrowList = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach($borrowList as $item){
                $borrow = new Borrow(
                    $item['item_id'],
                    $item['user_name'],
                    $item['type'],
                    $item['expected_date'],
                );
                $borrow->setId($item['id']);
                $borrow->setItemDescription($item['description']);

                $array[] = $borrow;
            }
        }

        return $array;
    }

    public function setReturned($id)
    {
        $aux = '2023-05-23 17:51:00';
        $sql = $this->pdo->prepare("UPDATE borrow SET effective_date = :effective_date WHERE id = :id");
        $sql->bindValue(':effective_date', $aux);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function findById($id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM borrow WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $borrow = new Borrow($data['item_id'], $data['user_name'], $data['type'], $data['expected_date']);
            return $borrow;
        }

        return false;
    }
}