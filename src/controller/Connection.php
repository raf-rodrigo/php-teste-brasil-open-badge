<?php

class Connection {

    private $databaseFile;
    private $connection;

    public function __construct()
    {
        $this->databaseFile = realpath(__DIR__ . "/../database/db.sqlite");
        $this->connect();
    }

    private function connect()
    {
        return $this->connection = new PDO("sqlite:{$this->databaseFile}");
    }

    public function getConnection()
    {
        return $this->connection ?: $this->connection = $this->connect();
    }

    public function query($query)
    {
        $result = $this->getConnection()->query($query);

        $result->setFetchMode(PDO::FETCH_INTO, new stdClass);

        return $result;
    }

    /**
     * Método responsável por fazer a consulta nas três tabelas, users, colors e user_colors, realindo LEFT JOIM
     * @param $id
     * @return mixed
     */
    public function queryReadUserOnly($id)
    {
        $query = "SELECT users.id AS user_id,
                    users.name AS user_name,
                    users.email AS user_email,
                    user_colors.color_id AS color_id,
                    user_colors.user_id AS user_id_color,
                    colors.name AS color_name
                    FROM users
                    LEFT JOIN user_colors ON users.id = user_colors.user_id
                    LEFT JOIN colors ON user_colors.color_id = colors.id
                    WHERE users.id = :id";

        $statement = $this->getConnection()->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $name, $email)
    {
        $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";

        $statement = $this->getConnection()->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);

        $result = $statement->execute();

        // Verificar se a atualização foi bem-sucedida
        if ($result) {
            return $statement->rowCount(); // Retorna o número de linhas afetadas
        } else {
            return false; // Ou lançar uma exceção dependendo do fluxo do seu código
        }
    }

    /**
     * Método responsável para retronar o último id registrado no tabela
     * @return false|string
     */
    public function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }
}