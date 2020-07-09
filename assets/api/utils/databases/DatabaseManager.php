<?php
require_once __DIR__ . "/../../env.php";

class DatabaseManager
{
    private PDO $pdo;

    /**
     * DatabaseManager constructor.
     */
    public function __construct()
    {
        $options = array(
            "host=" . DB_HOST,
            "port=" . DB_PORT,
            "dbname=" . DB_NAME,
            "charset=utf8"
        );
        $this->pdo = new PDO(
            DB_DRIVER . ":" . join(";", $options),
            DB_USER,
            DB_PWD);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return array|null
     */
    public function findOne(string $sql, array $params = []): ?array
    {
        $statement = $this->createStatement($sql, $params);
        if ($statement === null) {
            return null;
        }
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row === false) {
            return null;
        }
        return $row;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return PDOStatement|null
     */
    private function createStatement(string $sql, array $params = []): ?PDOStatement
    {
        $statement = $this->pdo->prepare($sql);
        if ($statement === null) {
            return null;
        }
        $res = $statement->execute($params);
        if ($res === false) {
            return null;
        }
        return $statement;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return int
     */
    public function exec(string $sql, array $params = []): int
    {
        $statement = $this->createStatement($sql, $params);
        if ($statement === null) {
            return 0;
        }
        return $statement->rowCount();
    }

    /**
     * @return string
     */
    public function getLastInsertId(): string
    {
        return $this->pdo->lastInsertId();
    }

    public function getAll(string $sql, array $parmas = []): array
    {
        $statement = $this->createStatement($sql, $parmas);
        if ($statement === null) {
            return [];
        }
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}