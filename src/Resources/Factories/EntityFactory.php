<?php

namespace Kernel\Resources\Factories;

use Kernel\Resources\Entity;

class EntityFactory
{
    public static function make(string $class): Entity
    {
        $class = 'App\\Models\\'.ucfirst($class);

        return new $class();
    }
}
