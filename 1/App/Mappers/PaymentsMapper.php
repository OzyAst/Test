<?php
namespace Ozycast\App\Mappers;

use PDO;
use Ozycast\App\Core\Db;
use Ozycast\App\DTO\Payments;

class PaymentsMapper
{
    /**
     * @var Db
     */
    private $connect = null;

    /**
     * @var string
     */
    private $collectName = "payments";

    /**
     * ChannelMapper constructor.
     * @param DB $db
     */
    public function __construct($db)
    {
        $this->connect = $db;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return \PDOStatement
     */
    public function sql(string $sql, $params = []) : \PDOStatement
    {
        $stmt = $this->connect->sql($sql, $params);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Payments::class);
        return $stmt;
    }
}