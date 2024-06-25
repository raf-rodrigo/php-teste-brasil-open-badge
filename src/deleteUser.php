<?php

/**
 * Arquivo responsável por realizar a exclusão do registro na tabela users e as cores referentes ao usuário
 * na tabela user_colors
 */

require __DIR__ .'/controller/CrudController.php';

/**
 * Verificação dos parâmetros envias via GET
 */
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    /**
     * Instância da classe CrudController
     */
    $crud = new CrudController();

    /**
     * Primeiro eu deleto o usuário
     */
    $deleteUser = $crud->deleteUser($id);

    /**
     * se a exclusão do usuário for completa, é feito a exclusão de todas a s cores referente a registro excluido
     */
    $deleteUserIdColors = $crud->deleteUserColorsAll($id);

    /**
     * Redireciona para a página index.php
     */
    header('Location: index.php');
    exit();


}