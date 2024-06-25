<?php

require __DIR__ . '/controller/CrudController.php';

/**
 * Validação dos parâmetros
 */
if (isset($_GET['id'], $_GET['color-id'])) {
    $userId = $_GET['id'];
    $colorId = $_GET['color-id'];

    $crud = new CrudController();

    $deleteColorUser = $crud->deleteUserColors($userId, $colorId);


    header('Location: readUser.php?id='.$userId);
    exit();
}
