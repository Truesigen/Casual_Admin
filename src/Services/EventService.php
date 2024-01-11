<?php

namespace App\Service;

class EventService
{
    public function insertEvent(string $user, string $theme, string $description)
    {
        return $this->events->insert(['header' => $theme, 'description' => $description, 'created_by' => $user]);
    }
}
