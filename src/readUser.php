<?php
/**
 * Arquivo que vai mostrar a página de visualização e update do usuário
 */
require __DIR__ . '/Model/User.php';
require __DIR__ . '/controller/CrudController.php';


/**
 * Validando os valores id e page
 */
if (isset($_GET['id'])) {

    $id = $_GET['id'];


    /**
     * Instância da classe CrudController
     */
    $crud = new CrudController();

    $readUserOnly = $crud->readUserOnly($id);
//    echo '<pre>'; print_r($readUserOnly); echo '</pre>';die();

    $colors = $crud->checkColor();

}
include ("includes/header.php");

?>
<section class="page-section master min-vh-80 mb-0" id="master">
    <div class="container min-vh-80 d-flex justify-content-center">
        <div class="w-75">
            <div>
                <h3 class="text-center mt-2">Visualizar e Editar Registro</h3>
                <form action="updateUser.php" method="POST">
                    <input type="hidden" id="id" name="id" value="<? print_r($readUserOnly[0]['user_id']); ?>">
                    <div class="form-group my-4">
                        <label for="name" class="text-start">Nome</label>
                        <input type="text" id="name" name="name" class="form-control" value="<? print_r($readUserOnly[0]['user_name']); ?>">
                    </div>
                    <div class="form-group my-4">
                        <label for="email" class="text-start">Email</label>
                        <input type="text" id="email" name="email" class="form-control" value="<? print_r($readUserOnly[0]['user_email']); ?>">
                    </div>
                    <p class="text-danger">Observação: Para alterar o valor da cor é necessário deletar a cor e adicionar uma nova cor.</p>
                    <div class="row g-2 align-items-center">
                        <?php if (!empty($readUserOnly) && count($readUserOnly) > 0) { ?>
                            <?php foreach ($readUserOnly as $user) { ?>
                                <div class="form-group col-10">
                                    <?php if (!empty($user['color_id']) && !empty($user['color_name'])) { ?>
                                        <label for="color">Cor</label>
                                        <select name="colors[]" class="form-select form-control text-start justify-content-between">
                                            <option value="<?php echo $user['color_id']; ?>"><?php echo $user['color_name']; ?></option>
                                        </select>
                                    <?php } else { ?>
                                        <p>Nenhuma cor associada a este usuário.</p>
                                    <?php } ?>
                                </div>
                                <div class="col-2">
                                    <?php if (!empty($user['color_id']) && !empty($user['color_name'])) { ?>
                                        <a href="deleteCorUser.php?id=<?php echo $user['user_id']; ?>&color-id=<?php echo $user['color_id']; ?>" type="button" class="btn btn-outline-danger">Deletar Cor</a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <p>Nenhum usuário encontrado com cores associadas.</p>
                        <?php } ?>
                    </div>
                    <div id="colors-container"></div>
                    <div>
                        <button type="button" id="add-color-btn" class="btn btn-outline-primary mt-2">Adicionar Cor</button>
                    </div>
                    <script type="text/template" id="color-template">
                        <div class="form-group my-4">
                            <label for="color">Cor</label>
                            <select name="colors[]" id="color" class="form-select form-control text-start justify-content-between">
                                <?php foreach ($colors as $color) { ?>
                                    <option value="<?php echo $color['id']; ?>"><?php echo $color['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </script>

                    <hr/>
                    <div class="w-100 d-flex justify-content-end">
                        <div class="">
                            <a href="index.php" type="button" class="btn btn-outline-secondary">Voltar</a>
                            <button type="submit" class="btn btn-outline-primary">Atualizar Registro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    document.getElementById('add-color-btn').addEventListener('click', function() {
        var template = document.getElementById('color-template').innerHTML;
        var container = document.getElementById('colors-container');
        var newColorSelect = document.createElement('div');
        newColorSelect.innerHTML = template;
        container.appendChild(newColorSelect);
    });
</script>
<?php include ("includes/footer.php");?>