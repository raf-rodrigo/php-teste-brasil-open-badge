<?php

$conn = new CrudController();

$page = 2;

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
 * Fazendo o módulo de numberRecords por limit, para mostra a quantidade de registros
 */
$showingRecords = $numberRecords % $limit;
/**
 * Calculando o deslocamento do offset
 */
$offSet = ($page - 1) * $limit;

?>
<!-- Sessão Principal -->
<section class="page-section master min-vh-90 mb-0" id="master">
    <div class="container">
        <!-- Cabeçalho da Sessão -->
        <h4 class="page-section-heading text-center text-uppercase text-1_5 text-semibold text-secondary mb-0 mt-2 my-auto">Usuários</h4>
        <div class="d-flex justify-content-end my-4">
            <button type="button" class="btn btn-outline-primary text-semibold" data-bs-toggle="modal" data-bs-target="#createUserModal">Novo Cadastro</button>
        </div>
        <? if (empty($users)): ?>
            <div class="w-100 my-5">
                <p class="text-center">Nenhum Usuário cadastrado</p>
            </div>
        <? else: ?>
            <div class="w-100">
                <!-- Tabela -->
                <div class="row mb-2">
                    <table class="table table-striped p-0" id="tableUser">
                        <thead>
                        <tr>
                            <th class="text-center col-1">ID</th>
                            <th class="text-center col-3">Nome</th>
                            <th class="text-center col-4">Email</th>
                            <th class="text-center col-1">Cor</th>
                            <th class="text-center col-3">Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        <? foreach ($users as $user): ?>
                            <tr>
                                <td class='align-middle text-center'><? echo $user['id']; ?> </td>
                                <td class='align-middle text-center'><? echo $user['name']; ?> </td>
                                <td class='align-middle text-center'><? echo $user['email']; ?> </td>
                                <td class='align-middle text-center'><? echo $user['color_name'] ?> </td>
                                <td class='align-middle text-center'>
                                    <a href="readUser.php?page=<?=$page;?>&id=<? echo $user['id']; ?>"><span title="Editar Registro"><img src="public/assets/icon/edit.svg" width="30"/></span></a>
                                    <a href="deleteUser.php?page=<?=$page;?>&id=<? echo $user['id']; ?>"><span title="Excluir Registro"><img src="public/assets/icon/trash.svg" width="30"/></span></a>
                                </td>
                            </tr>
                        <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="py-2">
                    <? if ($page == $totalPages){
                        if ($showingRecords == 0) {
                            $showingRecords = $limit;
                    }?>
                        <span>Mostrando <?= min($showingRecords, $numberRecords - $offSet);?> de <?=$numberRecords;?> registros.</span>
                    <?} else{
                        $showingRecords = $limit;
                    ?>
                        <span>Mostrando <?= min($showingRecords, $numberRecords - $offSet); ?> de <?=$numberRecords;?> registros.</span>
                    <?}?>
                </div>
                <div class="">
                    <? if ($page > 1): ?>
                        <a href="index.php?page=1" type="button" class="btn btn-outline-secondary mx-1">Primeira Página</a>
                        <a href="index.php?page=<?=$page-1;?>" type="button" class="btn btn-outline-secondary mx-1"><?=$page-1;?></a>
                    <? endif; ?>
                    <a href="" type="button" class="btn btn-outline-secondary mx-1 active"><?=$page; ?></a>
                    <? if ($page < $totalPages): ?>
                        <a href="index.php?page=<?=$page+1;?>" type="button" class="btn btn-outline-secondary mx-1"><?=$page+1;?></a>
                        <a href="index.php?page=<?=$totalPages;?>" id="delete" type="button" class="btn btn-outline-secondary mx-1">Últina Página</a>
                    <? endif; ?>
                </div>
            </div>
        <? endif; ?>
    </div>
</section>
