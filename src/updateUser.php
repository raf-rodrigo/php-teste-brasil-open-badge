<?php
/**
 * Arquivo responsável por realizar o update do registro
 */
require __DIR__ . '/Model/User.php';
require __DIR__ . '/controller/CrudController.php';

/**
 * Validação
 */
if (isset($_POST)){

    /**
     * craindo a variável array colors com a recuperação através do post
     */
    $colors = empty($_POST['colors']) ? [] : $_POST['colors'];

    /**
     * Instanciando a classe User e a classe CrudController
     */
    $update = new User();

    $crud = new CrudController();

    $update->id = $_POST['id'];
    $update->name = $_POST['name'];
    $update->email = $_POST['email'];

    /**
     * Parte que realiza o update do registro
     */
    $updateUser = $crud->updateUser([
        'id' => $update->id,
        'name' => $update->name,
        'email' => $update->email,
    ]);

    /**
     * criando a variável $id com a recuperação através do $_POST
     */
    $id = $_POST['id'];

    /**
     * Verificando se a array $colors tem algum valor, caso tenha chama o método insertColor para inserir valores
     * na tabela user_colors, não não tiver não faz nada
     */
    if (empty($colors) || empty(array_filter($colors))) {

        header('Location: index.php');
        exit();

    }else{
        /**
         * se a variável colors conter valores, através do for, é realizado alguns processos
         */
        for ($i = 0; $i < count($colors); $i++){

            /**
             * Verifica se a color existe já cadastrado na tabela user_colors
             */
            $record = $crud->consultRecord($id, $colors[$i]);

            /**
             * se existir o cadastro, o retorno será um int maior que 0
             * e entra no if fazendo o código seguir
             */
            if ($record > 0 ) {
                continue;

            /**
             * Caso o registro não exita, entra no else
             * que irar fazer a inserção da nova cor na tabela user_colors
             */
            }else {

                $insertColor = $crud->insertColorUpdate($id, $colors[$i]);

            }

        }

    }

    /**
     * Redireciona para a página index.php
     */
    header('Location: index.php');
    exit();
}

