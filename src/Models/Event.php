<?php

namespace App\Models;

use App\Resourses\Entity;

class Event extends Entity
{
    public function __construct(\PDO $dbc)
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
            'created_by',
        ];
    }

    public function findAll(): array
    {
        $eventsList = [];
        $sql = 'SELECT events.*, users.name FROM events LEFT JOIN users ON users.id = events.created_by WHERE events.user_id IS NULL ORDER BY id DESC';
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if ($data) {
            $eventsList = array_map(function ($data) {
                $class = new Event($this->dbc);

                foreach ($data as $key => $value) {
                    $class->$key = $value;
                }

                return $class;
            }, $data);
        }

        return $eventsList;
    }
}
