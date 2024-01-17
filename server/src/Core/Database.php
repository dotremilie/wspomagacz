<?php

namespace Wspomagacz\Server\Core;

use PDO;
use PDOException;

use PDOStatement;
use Wspomagacz\Client\Constants\ErrorMessages;

class Database
{
    private ?PDO $pdo;
    private ?PDOStatement $stmt;

    private string $host;
    private string $dbname;
    private string $username;
    private string $password;

    public function __construct()
    {
        $this->host = Config::DB_HOST;
        $this->dbname = Config::DB_NAME;
        $this->username = Config::DB_USER;
        $this->password = Config::DB_PASSWORD;

        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die(ErrorMessages::DB_CONNECTION_FAILED . " (" . $e->getCode() . ") " . $e->getMessage());
        }
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die(ErrorMessages::DB_QUERY_FAILED . " (" . $e->getCode() . ") " . $e->getMessage());
        }
    }

    public function fetch($stmt)
    {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll($stmt)
    {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rowCount($stmt)
    {
        return $stmt->rowCount();
    }

    public function lastInsertId(): false|string
    {
        return $this->pdo->lastInsertId();
    }

    public function close(): void
    {
        $this->pdo = null;
    }
}