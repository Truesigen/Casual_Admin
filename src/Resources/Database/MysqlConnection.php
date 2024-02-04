<?php

namespace Kernel\Resources\Database;

final class MysqlConnection
{
    private static $instance = null;

    private static $connection;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new MysqlConnection();
        }

        return self::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }

    public static function connect()
    {
        /* Подключение к базе данных MySQL с помощью вызова драйвера */
        self::$connection = new \PDO('mysql:dbname=crm;host=127.0.0.1:3306', 'root', 'zero1019');
    }

    public static function getConnection(): \PDO
    {
        return self::$connection;
    }
}
