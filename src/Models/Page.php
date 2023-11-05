<?php

namespace App\Models;

use App\Resourses\Entity;

class Page extends Entity
{
    public function __construct(\PDO $dbc)
    {
        parent::__construct($dbc, 'pages');
    }

    protected function initFields(): void
    {
        $this->fields = [
            'id',
            'title',
            'content',
        ];
    }
}
