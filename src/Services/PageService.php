<?php

namespace App\Services;

class PageService
{
    private EntityInterface $events;

    public function __construct(EntityInterface $events)
    {
        $this->events = $events;
    }
}
