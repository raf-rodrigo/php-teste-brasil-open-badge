<?php

require __DIR__ .'/controller/CrudController.php';

/**
 * Verificação dos parâmetros envias via GET
 */
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    /**
     * Instância da classe CrudController
     */
    $crud = new CrudController();

    $deleteUser = $crud->deleteUser($id);

    $deleteUserIdColors = $crud->deleteUserColorsAll($id);

    header('Location: index.php');
    exit();


}