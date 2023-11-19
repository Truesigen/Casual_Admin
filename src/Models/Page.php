<?php

namespace App\Models;

use App\Resourses\Entity;

class Page extends Entity implements EntityInterface
{
    public function __construct(\PDO $dbc)
    {
        parent::__construct($dbc, 'pages');
    }

    public function initFields(): void
    {
        $this->fields = [
            'id',
            'title',
            'template',
        ];
    }
}
