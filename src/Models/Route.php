<?php

namespace App\Models;

use App\Resources\Entity;

class Route extends Entity
{
    public function __construct()
    {
        parent::__construct('routes');
    }

    protected function initFields(): void
    {
        $this->fields = [
            'id',
            'module',
            'action',
            'page_id',
            'pretty_url',
        ];
    }

    protected function hasOne()
    {
        return [
            'page',
            'id',
        ];
    }
}
