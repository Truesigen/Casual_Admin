<?php

namespace App\Models;

use App\Resourses\Entity;

class Routes extends Entity implements EntityInterface
{
    public function __construct(\PDO $dbc)
    {
        parent::__construct($dbc, 'routes');
    }

    public function initFields(): void
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
