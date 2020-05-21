<?php

namespace Ozycast\App\Models;

use Ozycast\App\App;
use Ozycast\App\Mappers\PaymentsMapper;
use Ozycast\App\Models\report\xml\PaymentsOverdue;

Class Payments
{
    /**
     * Создать отчет
     * @return array
     */
    public static function generateReport()
    {
        $payments = (new Payments())->findPaymentsWithoutLink();
        (new PaymentsOverdue())->create($payments);

        return ["status" => 1, "message" => "Done!"];
    }

    /**
     * Найти платежи с битой ссылкой
     * @return \PDOStatement
     */
    public function findPaymentsWithoutLink(): \PDOStatement
    {
        $payments = (new PaymentsMapper(App::$db))->sql("
            SELECT p.* FROM `payments` p
            LEFT JOIN credits c ON c.id = p.cred_id
            WHERE c.id IS NULL
        ");
        return $payments;
    }
}