<?php

namespace App\Models;

use Kernel\Resources\Entity;

class Page extends Entity
{
    public function __construct()
    {
        parent::__construct('pages');
    }

    protected function initFields(): void
    {
        $this->fields = [
            'id',
            'title',
            'template',
        ];
    }
}
