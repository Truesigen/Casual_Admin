<?php
/**
 * Class creating Database object by Singelton pattern
 */
final class DatabaseConnection
{
    private static $instance = null;

    private static $connection;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new DatabaseConnection();
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

        self::$connection = new PDO('mysql:dbname=crm;host=127.0.0.1:3306', 'root', 'zero1019');
    }

    public static function getConnection()
    {
        return self::$connection;
    }
}
