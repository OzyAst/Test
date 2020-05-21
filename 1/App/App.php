<?php

namespace Ozycast\App;

use Exception;
use Ozycast\App\Core\Db;
use Ozycast\App\Core\DbMysql;
use Ozycast\App\Models\Payments;

Class App
{
    public static $db = null;

    public function __construct($config)
    {
        self::getDb($config);
    }

    public function run()
    {
        try {
            $answer = Payments::generateReport();
        } catch (Exception $e) {
            $this->showMessage($e->getMessage(), []);
        }

        if (!isset($answer))
            $this->showMessage("Command not fount");

        $this->showMessage($answer['message'], $answer['data']);
    }

    public function getDb($config): Db
    {
        self::$db = (new DbMysql())->connect($config);
        return self::$db;
    }

    public function showMessage($message, $data = [])
    {
        print_r($message."\n\r");
        print_r($data);
    }
}
