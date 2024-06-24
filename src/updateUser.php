<?php

require __DIR__ . '/Model/User.php';
require __DIR__ . '/controller/CrudController.php';

$page = $_POST['page'];


/**
 * Instanciando a classe User e a classe CrudController
 */
$update = new User();
$crud = new CrudController();

$update->id = $_POST['id'];
$update->name = $_POST['name'];
$update->email = $_POST['email'];
$update->color = $_POST['color'];

$updateUser = $crud->updateUser([
                            'id' => $update->id,
                            'name' => $update->name,
                            'email' => $update->email,
                            'color' => $update->color,
                            ]);

header('Location: index.php?page='. $page);
exit();