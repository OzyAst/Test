<?php
namespace Ozycast\App\Core;

use PDO;

Class DbMysql implements Db
{
    private $db;

    public function connect(array $config): Db
    {
        if ($this->db)
            return $this->db;

        $username = $config["MYSQL_USER"];
        $password = $config["MYSQL_PASSWORD"];
        $host = $config["MYSQL_HOST"];
        $db = $config["MYSQL_DB"];

        try {
            $this->db = new PDO("mysql:dbname=$db;host=$host", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
            $this->db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
        } catch (\PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }

        return $this;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return object|null
     */
    public function sql(string $sql, array $params)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}