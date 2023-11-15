<?php

namespace App\Models;

use App\Resourses\Entity;

class User extends Entity
{
    public array $avatars;

    public function __construct(\PDO $dbc)
    {
        parent::__construct($dbc, 'users');
    }

    protected function initFields(): void
    {
        $this->fields = [
            'id',
            'name',
            'password',
            'avatar',
            'is_admin',
        ];

        $this->avatars = [
            'girl',
            'batman',
            'snow',
            'fire-man',
            'mask',
            'default',
        ];
    }

    public function avatar()
    {
        return "/assets/avatars/$this->avatar.jpg";
    }
}
