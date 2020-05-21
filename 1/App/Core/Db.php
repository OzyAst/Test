<?php
namespace Ozycast\App\Core;

interface Db
{
    public function connect(array $config): Db;

    public function sql(string $sql, array $params);
}