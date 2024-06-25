<!-- Sessão Principal -->
<section class="page-section master min-vh-90 mb-0" id="master">
    <div class="container">
        <!-- Cabeçalho da Sessão -->
        <h4 class="page-section-heading text-center text-uppercase text-1_5 text-semibold text-secondary mb-0 mt-2 my-auto">Registros</h4>
        <div class="d-flex justify-content-end my-4">
            <button type="button" class="btn btn-outline-primary text-semibold" data-bs-toggle="modal" data-bs-target="#createUserModal">Novo Registro</button>
        </div>
        <? if (empty($data)): ?>
            <div class="w-100 my-5">
                <p class="text-center">Nenhum Registro Cadastrado</p>
            </div>
        <? else: ?>
            <div class="w-100">
                <!-- Tabela -->
                <?php
                // Inicializar um array para armazenar os usuários únicos
                $unique_users = array();

                // Percorrer o array $users para agrupar por user_id
                foreach ($users as $user) {
                    $user_id = $user['user_id'];

                    // Verificar se o user_id já existe no array $unique_users
                    if (!isset($unique_users[$user_id])) {
                        // Se não existir, inicializar com os dados do primeiro registro encontrado
                        $unique_users[$user_id] = array(
                            'user_id' => $user['user_id'],
                            'user_name' => $user['user_name'],
                            'user_email' => $user['user_email'],
                            'colors' => array()
                        );
                    }

                    // Adicionar a cor associada ao usuário
                    $unique_users[$user_id]['colors'][] = array(
                        'color_id' => $user['color_id'],
                        'color_name' => $user['color_name']
                    );
                }
                ?>
                <div class="row mb-2">
                    <div class="col table-responsive">
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
                            <? foreach ($unique_users as $user): ?>
                                <tr>
                                    <td class='align-middle text-center'><? echo $user['user_id']; ?> </td>
                                    <td class='align-middle text-center'><? echo $user['user_name']; ?> </td>
                                    <td class='align-middle text-center'><? echo $user['user_email']; ?> </td>
                                    <td class="align-middle text-center">
                                        <? foreach ($user['colors'] as $color){
                                            echo $color['color_name'] . ' ';
                                        }?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="readUser.php?id=<? echo $user['user_id']; ?>"><span title="Editar Registro"><img src="../public/assets/icon/edit.svg" width="30" /></span></a>
                                        <button class="btn btn-link" onclick="openConfirmationModal(<? echo $user['user_id']; ?>)"><span title="Excluir Registro"><img src="../public/assets/icon/trash.svg" width="30" /></span></button>
                                    </td>
                                </tr>
                            <? endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                 <!-- ----------Paginação---------- -->
                <div class="d-flex justify-content-end mb-0">
                    <? if ($page > 1): ?>
                        <a href="index.php?page=1" type="button" class="btn btn-outline-primary mx-1">Primeira Página</a>
                        <a href="index.php?page=<?=$page-1;?>" type="button" class="btn btn-outline-primary mx-1"><? echo $page - 1; ?></a>
                    <? endif; ?>
                    <a href="" type="button" class="btn btn-outline-primary mx-1 active"><? echo $page; ?></a>
                    <? if ($page < $totalPages): ?>
                        <a href="index.php?page=<?=$page+1;?>" type="button" class="btn btn-outline-primary mx-1"><? echo $page + 1; ?></a>
                        <a href="index.php?page=<?=$totalPages;?>" type="button" class="btn btn-outline-primary mx-1">Última Pagina</a>
                    <? endif; ?>
                </div>
            </div>
        <? endif; ?>
    </div>
</section>

<!-- Modal Delete -->
<div id="confirmationModal" class="modal">
    <div class="modal-dialog border border-opacity-100 border-danger rounded-4">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Registro</h5>
            </div>
            <div class="modal-body">
                <p>Você tem certeza que deseja excluir este registro?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST" action="../deleteUser.php">
                    <input type="hidden" id="recordId" name="id">
                    <button class="btn btn-outline-primary" type="button" onclick="closeConfirmationModal()">Cancelar</button>
                    <button class="btn btn-outline-danger" type="button" onclick="submitForm()">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openConfirmationModal(id) {
        document.getElementById('recordId').value = id;
        document.getElementById('confirmationModal').style.display = 'block';
    }

    function closeConfirmationModal() {
        document.getElementById('confirmationModal').style.display = 'none';
    }

    function submitForm() {
        document.getElementById('deleteForm').submit();
    }
</script>
