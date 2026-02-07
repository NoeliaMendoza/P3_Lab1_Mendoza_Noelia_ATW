<?php

namespace Framework;

use PDO;

class Database
{
    private $connection;
    private $statement;

    public function __construct()
    {
        $host = getenv('DOCKER_ENV') ? 'postgres' : 'localhost';
        $port = '5432';
        $dbname = 'web';
        $user = 'espe';
        $password = 'espe';

        $dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";

        try {
            $this->connection = new PDO($dsn, $user, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    /**
     * Ejecuta una consulta SQL
     */
    public function query($sql, $params = [])
    {
        $this->statement = $this->connection->prepare($sql);
        $this->statement->execute($params);
        return $this;
    }

    /**
     * Obtiene todos los resultados
     */
    public function get()
    {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene el primer resultado o lanza error 404
     */
    public function firstOrFail()
    {
        $result = $this->statement->fetch(PDO::FETCH_ASSOC);
        if ($result === false) {
            http_response_code(404);
            echo view('errors.404');
            exit;
        }
        return $result;
    }

    /**
     * Obtiene el primer resultado o null
     */
    public function first()
    {
        return $this->statement->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Obtiene el ID del último registro insertado
     */
    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }

    /**
     * Obtiene la conexión PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}