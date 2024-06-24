<?php

require __DIR__ . '/Model/User.php';
require __DIR__ . '/controller/CrudController.php';


/**
 * Validando os valores id e page
 */
if (isset($_GET['page'], $_GET['id'])) {

    $id = $_GET['id'];
    $page = $_GET['page'];

    /**
     * Instância da classe CrudController
     */
    $crud = new CrudController();

    $readUserOnly = $crud->readUserOnly($id)->fetch(PDO::FETCH_ASSOC);

    $idColor = $readUserOnly['color'];

    /**
     * Buscar no banco de dados a cor salva para o registro em questão
     */
    $colorUser = $crud->readColorUser($idColor);

    $colors = $crud->checkColor();

}
include ("includes/header.php");
?>
<section class="page-section master min-vh-90 mb-0" id="master">
    <div class="container">
        <div class="w-100">
            <div class="d-flex justify-content-center">
                <form action="updateUser.php" method="POST">
                    <input type="hidden" id="id" name="id" value="<?=$id; ?>" />
                    <input type="hidden" id="page" name="page" value="<?=$page; ?>" />
                    <div class="">
                        <div class="form-group my-4">
                            <label for="name" class="text-start">Nome</label>
                            <input type="text" id="name" name="name" class="form-control" value="<? echo $readUserOnly['name']; ?>" required>
                        </div>
                        <div class="form-group my-4 ">
                            <label for="email" class="text-start">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<? echo $readUserOnly['email']; ?>" required>
                        </div>
                        <div class="form-group my-4 ">
                            <label for="color">Cor</label>
                            <select id="color" name="color" class="form-select form-control text-start justify-content-between">
                                <option value="<? echo $readUserOnly['color']; ?>" selected><? empty($colorUser['name']) ? " " : print_r($colorUser['name']);?></option>
                                <? foreach ($colors as $color){?>
                                    <option value="<? print_r($color['id']);?>"><? print_r($color['name']); ?></option>
                                <?}?>
                            </select>
                        </div>
                    </div>
                        <a href="index.php?page=<?=$page?>" type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</a>
                        <button type="submit" class="btn btn-outline-primary">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include ("includes/footer.php");

