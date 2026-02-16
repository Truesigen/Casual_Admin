<?php

namespace Kernel\Resources\Helpers;

final class ConfigurationMaster
{
    private static string $configFilePath;

    private static false|array $configFile;

    public static function get(string $path): false|array
    {
        $path = explode('.', $path);

        self::$configFilePath = './src/config/'.array_shift($path).'.php';

        self::$configFile = file_exists(self::$configFilePath) ? include self::$configFilePath : false;

        if (empty($path) || ! self::$configFile) {
            return self::$configFile;
        }

        foreach ($path as $value) {
            if (array_key_exists($value, self::$configFile)) {
                $newConfigData = self::$configFile[$value];
                self::$configFile = $newConfigData;
            }
        }

        return self::$configFile;
    }

    public static function config(string $configuration)
    {
        $env = parse_ini_file(ROOT_PATH.'/.env');

        return $env[$configuration] ?? null;
    }
}
