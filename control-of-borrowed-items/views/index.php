<?php

use Will\Borrowed\Controllers\Views\IndexController;

$indexController = new IndexController();
$borrowList = $indexController->index();
?>

<a href="create" style="margin-bottom: 20px">
    <h2>Novo Registro</h2>
</a>

<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>ITEM ID</th>
        <th>USER NAME</th>
        <th>TYPE</th>
        <th>EXPECTED DATE</th>
        <th>AÇÕES</th>
    </tr>
    <?php foreach($borrowList as $item): ?>
        <tr>
            <td><?= $item->id(); ?></td>
            <td><?= $item->itemDescription(); ?></td>
            <td><?= $item->userName(); ?></td>
            <td><?= $item->type(); ?></td>
            <td><?= $item->expectedDate(); ?></td>
            <td>
                <a href="/control-of-borrowed-items/returnedAction/<?= $item->id(); ?>" onclick="return confirm('Deseja marcar o item como devolvido?');">Devolvido</a>

            </td>
        </tr>
    <?php endforeach; ?>
</table>