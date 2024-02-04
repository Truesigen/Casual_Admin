<?php

namespace App\Models;

use Kernel\Resources\Entity;

class Event extends Entity
{
    public function __construct()
    {
        parent::__construct('events');
    }

    protected function initFields(): void
    {
        $this->fields = [
            'id',
            'header',
            'description',
            'user_id',
            'created_by_user_id',
            'created_at',
        ];
    }
}
