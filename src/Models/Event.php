<?php

namespace App\Models;

use App\Resourses\Entity;

class Event extends Entity
{
    public function __construct($dbc)
    {
        parent::__construct($dbc, 'events');
    }

    protected function initFields(): void
    {
        $this->fields = [
            'id',
            'user_id',
            'header',
            'description',
            'created_at',
        ];
    }
}
