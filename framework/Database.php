<?php
class Database
{
    private $connection;
    private $statement;

    public function __construct()
    {
        $host     = getenv('DOCKER_ENV') ? 'postgres' : 'localhost';
        $port     = '5432';
        $dbname   = 'web';
        $user     = 'espe';
        $password = 'espe';

        $dsn              = "pgsql:host={$host};port={$port};dbname={$dbname}";
        $this->connection = new PDO($dsn, $user, $password);
    }

    public function query($sql, $params = [])
    {
        $this->statement = $this->connection->prepare($sql);
        $this->statement->execute($params);
        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function firstOrFail()
    {
        $result = $this->statement->fetch(PDO::FETCH_ASSOC);
        if ($result === false) {
            http_response_code(404);
            exit('404 Not Found');
        }
        return $result;
    }
}
