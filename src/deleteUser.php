<?php

require __DIR__ .'/controller/CrudController.php';

$conn = new CrudController();

$page = 1;

$limit = 6;

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
 * Fazendo o módulo de numberRecords por limit, para mostra a quantidade de registros
 */
$showingRecords = $numberRecords % $limit;


/**
 * Verificação dos parâmetros envias via GET
 */
if (isset($_GET['page'],$_GET['id'])) {
    $id = $_GET['id'];
    $page = $_GET['page'];

    /**
     * Instância da classe CrudController
     */
    $crud = new CrudController();

    $deleteUser = $crud->deleteUser($id);

    /**
     * Retorna para a página onde o registro excluido estava ou para a página anterior caso o registro seja o ultimo da página
     */
    if ($page == $totalPages && $showingRecords == 1) {
        header('Location: index.php?page='. ($page - 1));
    }else {
        header('Location: index.php?page='.$page);
        exit();
    }

}