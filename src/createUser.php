<?php

require __DIR__ . '/Model/User.php';
require __DIR__ . '/controller/CrudController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $colors = isset($_POST['colors']) ? $_POST['colors'] : [];

//    echo '<pre>'; print_r($_POST); echo '</pre>';die();

    /**
     * Validar os valores dos campos name e email
     */
    if (isset($_POST['name'], $_POST['email'])) {
        /**
         * Intanciando a classe User
         */
        $createuser = new User();

        $createuser->name = $_POST['name'];
        $createuser->email = $_POST['email'];



        /**
         * Criando uma array da instância da classe User e instanciando a classe CrudController
         * Enviando para o método insertUser da  classe CrudController a array
         */
        $crud = new CrudController();
        $insertUser = $crud->insertUser([
            'name' => $createuser->name,
            'email' => $createuser->email,
        ]);

        $id = $insertUser;


        /**
         * Verificando se a array $colors tem algum valor, caso tenha chama o método insertColor para inserir valores
         * na tabela user_colors, não não tiver não faz nada
         */
        if (empty($colors) || empty(array_filter($colors))) {
            return;
        }else {
            $insertColor = $crud->insertColor($id, $colors);
        }


        /**
         * Redirecionado para a página  dependendo do valor do last-page
         */
        header('Location: index.php');
        exit();

    }
}