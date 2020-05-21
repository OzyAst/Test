<?php

namespace Ozycast\App\Models\report\log;

Class Log
{
    const FILE_RESULT = "App/logs/log";

    /**
     * Добавить запись в файл
     * @param string $message
     */
    public static function add(string $message)
    {
        (new Log())->save($message);
    }

    /**
     * Сохранить файл
     * @param string $line
     */
    public function save(string $line)
    {
        file_put_contents(self::FILE_RESULT, $line . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}