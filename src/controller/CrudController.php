<?php

require __DIR__ . '/Connection.php';

class CrudController
{
    /**
     * Realiza conculta do usuário fazendo união com a tabela colors,
     * para ao invés de trazer o a coluna id traga a coluna name
     * @param $limit
     * @param $start
     * @return array|false
     */
    public function readUser($limit, $start)
    {
        /**
         * Instânciando a classe Connection
         */
        $connection = new Connection();

        /**
         * Montando a query de read do user fazendo junção com a tabela colors e passando parâmetros para realizar a
         * paginação
         */
        $queryUsers = $connection->query("SELECT users.id, users.name, users.email, colors.name AS color_name, colors.id AS color_id FROM users LEFT JOIN colors ON users.color = colors.id LIMIT $start, $limit");

        $users = $queryUsers->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    /**
     * Função que realiza a contagem de registro no banco de dados
     * @return mixed
     */
    public function countUsers()
    {
        $connection = new Connection();

        /**
         * Montando a query de consulta de números de registros
         */
        $queryCountUsers = $connection->query("SELECT COUNT(*) count FROM users");

        $countUsers = $queryCountUsers->fetch(PDO::FETCH_ASSOC)["count"];

        return $countUsers;
    }

    /**
     * Consulta na tabeça colors para ser inserido no select
     * @return array|false
     */
    public function checkColor()
    {
        $connection = new Connection();

        /**
         * Montando a query para buscar as cores a ser utilizado no cadastro do usuário
         */
        $queryColors = $connection->query("SELECT * FROM colors");

        $colors = $queryColors->fetchAll(PDO::FETCH_ASSOC);

        return $colors;
    }

    /**
     * Método que realiza a busca de somente de um usuário do id recebido
     * @param $id integer
     * @return false|PDOStatement
     */
    public function readUserOnly($id)
    {
        $connection = new Connection();

        $query = "SELECT * FROM users where id = {$id}";

        $userOnly = $connection->query($query);

        return $userOnly;
    }

    /**
     * Método responsávelpor recuperar o name da cor do registro recebendo como parâmetro o id
     * @param $id
     * @return mixed
     */
    public function readColorUser($id)
    {
        $connection = new Connection();

        $query = "SELECT name FROM colors WHERE id={$id}";

        $colorUser = $connection->query($query)->fetch(PDO::FETCH_ASSOC);

        return $colorUser;

    }

    /**
     * Método responsável por inserir dados no banco
     * @param array $values [ field => value ]
     * @return mixed
     */
    public function insertUser($values)
    {
        $connection = new Connection();

        /**
         * Convertendo as keys string em interger
         */
        $fields = array_values($values);


        /**
         * Separandoo os valores da array enviada
         */
        $fieldsName = $fields[0];
        $fieldsEmail = $fields[1];
        $fieldsColor = $fields[2];

        /**
         * Montando a query da inserção do usuário
         */
        $query = "INSERT INTO users (name,email,color) VALUES ('{$fieldsName}','{$fieldsEmail}','{$fieldsColor}')";

        $insert = $connection->query($query);

        return $insert;
    }

    public function updateUser($values)
    {
        $connection = new Connection();

        /**
         * Convertendo as keys string em interger
         */
        $fields = array_values($values);

        /**
         * Separandoo os valores da array enviada
         */
        $id = $fields[0];
        $name = $fields[1];
        $email = $fields[2];
        $color = $fields[3];

        /**
         * Montando a query
         */
        $query = "UPDATE users SET name='{$name}', email='{$email}', color='{$color}' WHERE id={$id}";

        $updateUser = $connection->query($query);

        return $updateUser;
    }

    /**
     * Método responsávelpor fazer a exclusão do registro do usuário na tabela users
     * @param $id integer
     * @return false|PDOStatement
     */
    public function deleteUser($id)
    {
        $connection = new Connection();

        $query = "DELETE FROM users WHERE id={$id}";

        $deleteuser = $connection->query($query);

        return $deleteuser;
    }
}