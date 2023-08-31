<?php

    use Will\Borrowed\Dao\BorrowDao;

    $pdo = new PDO("mysql:dbname=control_of_borrowed_items;host=localhost", "root", "");

    $id = $vars['id'];

    $borrowDao = new BorrowDao($pdo);
    $borrowDao->setReturned($id);

    header("Location: /control-of-borrowed-items");
    exit;