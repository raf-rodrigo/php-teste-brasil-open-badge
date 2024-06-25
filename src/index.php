<?php
/**
 * Arquivo incial do projeto
 * As partes foram dividas e inseridas denro do arquivo includes, para manter um código limpo
 */

require __DIR__ . '/controller/CrudController.php';

/**
 * Os três código abaixo faz a instancia da classe CrudController
 * Buscas os registro
 * Buscas os id e nome das cores na tabela colors
 */
$crud = new CrudController();

$users = $crud->readUser();

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


