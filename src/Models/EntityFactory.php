<?php

namespace App\Models;

use App\Resourses\DatabaseConnection;

class EntityFactory
{
    public static function make(string $class): EntityInterface
    {
        $class = 'App\Models\\'.$class;

        return new $class(DatabaseConnection::getConnection());
    }
}
