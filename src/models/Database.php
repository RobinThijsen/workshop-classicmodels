<?php
declare(strict_types=1);
namespace models;

use PDO;
use PDOStatement;

class Database
{
    private PDO $pdo;

    /**
     * construct of database
     */
    public function __construct()
    {
        $this->pdo = new PDO(
            "mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_DATABASE'),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD')
        );

        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    /**
     * @param string $sql sql request with param
     * @param array $param array of param in sql request
     * @return PDOStatement result of query
     */
    public function query(string $sql, array $param = []): PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        foreach ($param as $k => $v) {
            if (gettype($v) == "integer") {
                $stmt->bindParam($k, $v, PDO::PARAM_INT);
            } else {
                $stmt->bindValue($k, $v);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    /**
     * @param string $sql request of exec
     * @param array $param param to bind
     * @return bool result of exec
     */
    public function exec(string $sql, array $param = []): bool
    {
        $stmt = $this->pdo->prepare($sql);
        foreach ($param as $k => $v) {
            if (gettype($v) == "integer") {
                $stmt->bindParam($k, $v, PDO::PARAM_INT);
            } else {
                $stmt->bindValue($k, $v);
            }
        }
        return $stmt->execute();
    }

    /**
     * @return bool|string result of lastInsertId()
     */
    public function lastInsertId(): bool|string
    {
        return $this->pdo->lastInsertId();
    }
}

?>