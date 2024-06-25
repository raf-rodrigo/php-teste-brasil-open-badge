<?php

require __DIR__ . '/Model/User.php';
require __DIR__ . '/controller/CrudController.php';

if (isset($_POST)){


    $colors = $_POST['colors'];
    /**
     * Instanciando a classe User e a classe CrudController
     */
    $update = new User();

    $crud = new CrudController();


    $update->id = $_POST['id'];
    $update->name = $_POST['name'];
    $update->email = $_POST['email'];

    $updateUser = $crud->updateUser([
        'id' => $update->id,
        'name' => $update->name,
        'email' => $update->email,
    ]);

    $id = $_POST['id'];
    /**
     * Verificando se a array $colors tem algum valor, caso tenha chama o método insertColor para inserir valores
     * na tabela user_colors, não não tiver não faz nada
     */
    if (empty($_POST['colors']) || empty(array_filter($_POST['colors']))) {
        header('Location: index.php');
        exit();
    }else{

        for ($i = 0; $i < count($colors); $i++){

            $record = $crud->consultRecord($id, $colors[$i]);

            if ($record > 0 ) {

                continue;
            }else {

                $insertColor = $crud->insertColorUpdate($id, $colors[$i]);

            }

        }

    }

    header('Location: index.php');
    exit();
}

