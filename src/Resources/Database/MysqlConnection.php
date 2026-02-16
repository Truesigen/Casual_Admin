<?php

namespace Kernel\Resources\Database;

use Kernel\Resources\Helpers\ConfigurationMaster;

final class MysqlConnection
{
    private static $instance = null;

    private static $connection;

    private static string $name;

    private static string $host;

    private static string $port;

    private static string $username;

    private static string $password;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new MysqlConnection;
        }

        return self::$instance;
    }

    private function __construct() {}

    private static function prepareCredits()
    {
        self::$name = ConfigurationMaster::config('DB_DATABASE');
        self::$host = ConfigurationMaster::config('DB_HOST');
        self::$port = ConfigurationMaster::config('DB_PORT');
        self::$username = ConfigurationMaster::config('DB_USERNAME');
        self::$password = ConfigurationMaster::config('DB_PASSWORD');
    }

    private function __clone() {}

    public function __wakeup() {}

    public static function connect()
    {
        self::prepareCredits();
        $options = [\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC];

        $dsn = 'mysql:host='.self::$host.';dbname='.self::$name;

        self::$connection = new \PDO($dsn, self::$username, self::$password, $options);
    }

    public static function getConnection(): \PDO
    {
        return self::$connection;
    }
}
