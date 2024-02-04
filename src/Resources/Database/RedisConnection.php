<?php

namespace Kernel\Resources\Database;

final class RedisConnection
{
    private static $redisInstance = null;

    public static function connect(): void
    {
        if (is_null(self::$redisInstance)) {
            self::$redisInstance = new \Redis();
        }

        self::$redisInstance->connect('127.0.0.1');
    }

    public static function getRedis(): \Redis
    {
        return self::$redisInstance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }
}
