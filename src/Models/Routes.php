<?php

namespace App\Models;

use App\Resourses\Entity;

class Routes extends Entity
{
    public function __construct($dbc)
    {
        parent::__construct($dbc, 'routes');
    }

    protected function initFields(): void
    {
        $this->fields = [
            'id',
            'module',
            'action',
            'entity_id',
            'pretty_url',
        ];
    }
}
