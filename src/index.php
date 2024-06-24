<?php

require __DIR__ . '/controller/CrudController.php';

$conn = new CrudController();

$page = 1;

$limit = 5;

if (isset($_GET['page'])) {
    $page = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
}
if (!$page) {
    $page = 1;
}

$start = ($page * $limit) - $limit;

// Contidade de registros
$numberRecords = $conn->countUsers();

// Total de Página com arrendodamento para cima
$totalPages = ceil($numberRecords / $limit);

$users = $conn->readUser($limit, $start);

//echo '<pre>'; print_r($users); echo '</pre>';

$colors = $conn->checkColor();

/**
 * Inclusão da sessão header
 */
include ("includes/header.php");

/**
 * Inclusão da sessão main (tabela)
 */
include ("includes/main.php");

/**
 * Inclusão do modal cadastrar usuário
 */
include ("includes/modalCreate.php");

/**
 * Inclusão do rodapé
 */
include ("includes/footer.php");

?>


