<?php

require __DIR__ . '/Connection.php';

class CrudController
{
    /**
     * Realiza conculta do usuário fazendo união com a tabela colors,
     * para ao invés de trazer o a coluna id traga a coluna name
     * @param integer $limit
     * @param integer $start
     * @return array|false
     */
    public function readUser()
    {
        /**
         * Instânciando a classe Connection
         */
        $connection = new Connection();

        /**
         * Não foi permitido o envio diretoda query do select logo criei outro método no Connection com a query fixa
         */
        $query = "SELECT users.id AS user_id, users.name AS user_name, users.email AS user_email, user_colors.color_id AS color_id, user_colors.user_id AS user_id_color, colors.name AS color_name FROM users LEFT JOIN user_colors ON users.id = user_colors.user_id LEFT JOIN colors on user_colors.color_id = colors.id";

        $readUser = $connection->query($query)->fetchAll(PDO::FETCH_ASSOC);

//        echo '<pre>'; print_r($readUser);echo '</pre>';die();

        return $readUser;
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
     * Método esponável por verificar na tabela user_colors se já existeregistro
     * @param $id
     * @param $colors
     * @return mixed
     */
    public function consultRecord($id, $colors)
    {

        $connection = new Connection();

        $requestRecord = $connection->query("SELECT COUNT(*) count FROM user_colors WHERE user_id={$id} AND color_id={$colors}");

        $responseRecord = $requestRecord->fetch(PDO::FETCH_ASSOC)['count'];

        return $responseRecord;
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
     * @param integer $id
     * @return false|PDOStatement
     */
    public function readUserOnly($id)
    {
        $connection = new Connection();

//        $query = "SELECT users.id AS user_id,
//                    users.name AS user_name,
//                    users.email AS user_email,
//                    user_colors.color_id AS color_id,
//                    user_colors.user_id AS user_id_color,
//                    colors.name AS color_name
//                    FROM users
//                    LEFT JOIN user_colors ON users.id = user_colors.user_id
//                    LEFT JOIN colors ON user_colors.color_id = colors.id
//                    WHERE users.id = {$id}";

        $userOnly = $connection->queryReadUserOnly($id);

        return $userOnly;
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

        /**
         * Montando a query da inserção do usuário
         */
        $query = "INSERT INTO users (name,email) VALUES ('{$fieldsName}','{$fieldsEmail}')";


        $insert = $connection->query($query);

        if ($insert) {
            return $lastInsertId = $connection->lastInsertId();
        }
    }

    /**
     * Método responsável por salvar os valores das cores de cadastro de registro na tabela user_colors
     * @param $id integer
     * @param $values array
     * @return false|PDOStatement
     */
    public function insertColor($id, $values)
    {
        $connection = new Connection();
//        echo '<pre>'; print_r($values); echo '</pre>';die();
        /**
         * Verificando o comprimento da array valores
         */
        $tamanhoDeValues = count($values);

        for($i = 0; $i < $tamanhoDeValues; $i++){
            /**
             * query para cada interação for
             */
            $query = "INSERT INTO user_colors (user_id, color_id) VALUES ('{$id}','{$values[$i]}')";

            if (!empty($values[$i])){
                $insertColors = $connection->query($query);
            }

        }

        return $insertColors;

    }

    /**
     * Método responsável por realizar o update do registro
     * @param array $values
     * @return false|PDOStatement
     */
    public function updateUser($values)
    {
        $connection = new Connection();

        /**
         * Convertendo as keys string em interger
         */
        $fields = array_values($values);
//        echo '<pre>'; print_r($fields); echo '</pre>';die('metodo update');
        /**
         * Separandoo os valores da array enviada
         */
        $id = $fields[0];
        $name = $fields[1];
        $email = $fields[2];

        $updateUser = $connection->updateUser($id, $name, $email);


        return $updateUser;
    }

    /**
     * Metódo responsável por fazer o update do registro na parte da cores
     * @param integer $id
     * @param integer $color
     * @return false|PDOStatement
     */
    public function insertColorUpdate($id, $color)
    {

        $connection = new Connection();

        $query = "INSERT INTO user_colors (user_id, color_id) VALUES ({$id},{$color})";


        $insertColor = $connection->query($query);

        return $insertColor;
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

        $deleteUser = $connection->query($query);

        return $deleteUser;
    }

    /**
     * Método responsável por deletar todas as cores referente ao registro de id=x
     * @param integer $id
     * @return false|PDOStatement
     */
    public function deleteUserColorsAll($id)
    {

        $connection = new Connection();

        $query = "DELETE FROM user_colors WHERE user_id={$id}";

        $deleteUserColors = $connection->query($query);

        return $deleteUserColors;
    }

    /**
     * Método responsável por excluir somente uma cor da tabela user_colors
     * @param integer $userId
     * @param integer $colorId
     * @return false|PDOStatement
     */
    public function deleteUserColors($userId, $colorId)
    {

        $connection = new Connection();

        $query = "DELETE FROM user_colors WHERE user_id={$userId} AND color_id={$colorId}";

        $deleteUserColors = $connection->query($query);

        return $deleteUserColors;
    }
}