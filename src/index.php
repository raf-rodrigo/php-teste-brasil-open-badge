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
 * Paginação
 */
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5;

$start = ($page - 1) * $limit;

$conn = new Connection();

$data = $conn->getPaginatedResults($limit, $start);
// Exibir o resultado para debug
//foreach ($data as $row) {
//    echo 'ID: ' . $row->user_id . ' - Nome: ' . $row->user_name . ' - Email: ' . $row->user_email . ' - Cor: ' . $row->color_name . '<br>';
//}

$numberRecords = $conn->getTotalCount();

$totalPages = ceil($numberRecords / $limit);


/**
 * Final Paginação
 */

/**
 * Buscando as cores da tabalea colors
 */
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


