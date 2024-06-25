<?php

/**
 * Arquivo responsável por deletar somente uma cor na visualização do registro
 */
require __DIR__ . '/controller/CrudController.php';

/**
 * Validação dos parâmetros
 */
if (isset($_GET['id'], $_GET['color-id'])) {
    $userId = $_GET['id'];
    $colorId = $_GET['color-id'];

    $crud = new CrudController();

    /**
     * Chamando o médoto para excluir
     */
    $deleteColorUser = $crud->deleteUserColors($userId, $colorId);

    /**
     * Redireciona para a página de visualização do registro
     */
    header('Location: readUser.php?id='.$userId);
    exit();
}
