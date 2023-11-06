<?php

namespace App\Models;

use App\Resourses\Entity;

class User extends Entity
{
    public function __construct(\PDO $dbc)
    {
        parent::__construct($dbc, 'users');
    }

    protected function initFields(): void
    {
        $this->fields = [
            'id',
            'name',
            'username',
            'password',
        ];
    }
}
