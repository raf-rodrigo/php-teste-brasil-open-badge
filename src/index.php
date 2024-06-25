<?php

require __DIR__ . '/controller/CrudController.php';

$crud = new CrudController();

$users = $crud->readUser();
//echo '<pre>'; print_r($users);echo '</pre>';die();

$colors = $crud->checkColor();


/**
 * Inclusão da sessão header
 */
include ("includes/header.php");

/**
 * Inclusão da sessão main (tabela)
 */
include ("includes/main.php");

/**
 * Inclusão do modal cadastrar  registro
 */
include ("includes/modalCreate.php");

/**
 * Inclusão do rodapé
 */
include ("includes/footer.php");

?>


