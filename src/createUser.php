<?php

require __DIR__ . '/Model/User.php';
require __DIR__ . '/controller/CrudController.php';

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
    $createuser->color = $_POST['color'];


    /**
     * Criando uma array da instância da classe User e instanciando a classe CrudController
     * Enviando para o método insertUser da  classe CrudController a array
     */
    $crud = new CrudController();
    $insertUser = $crud->insertUser([
                                    'name' => $createuser->name,
                                    'email' => $createuser->email,
                                    'color' => $createuser->color
                                    ]);



    /**
     * Redirecionado para a página inicial dependo do valor do last-page
     */
    if (empty($_POST['last-page'])){
        header('Location: index.php');
        exit();
    }else{
        header('Location: index.php?page='.$_POST['last-page']);
        exit();
    }

}