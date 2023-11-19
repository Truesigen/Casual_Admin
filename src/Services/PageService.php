<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;

class PageService
{
    private Event $events;

    private User $user;

    public function __construct(Event $events, User $user)
    {
        $this->events = $events;
        $this->user = $user;
    }

    public function checkPass(int $userId, string $userPass): bool
    {
        $userObj = $this->user->first('id', $userId);

        if (! empty($userObj) && property_exists($userObj, 'id')) {
            return password_verify($userPass, $userObj->password) ? 1 : 0;
        }

        return false;
    }

    public function insertEvent(string $user, string $theme, string $description)
    {
        return $this->events->insert(['header' => $theme, 'description' => $description, 'created_by' => $user]);
    }
}
