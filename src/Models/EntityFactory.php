<?php

namespace App\Models;

use App\Resources\Entity;

class EntityFactory
{
    public static function make(string $class): Entity
    {
        $class = 'App\Models\\'.ucfirst($class);

        return new $class();
    }
}
