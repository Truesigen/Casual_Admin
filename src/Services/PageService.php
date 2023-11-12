<?php

namespace App\Services;

use App\Resourses\EntityInterface;

class PageService
{
    private EntityInterface $events;

    private EntityInterface $user;

    public function __construct(EntityInterface $events, EntityInterface $user)
    {
        $this->events = $events;
        $this->user = $user;
    }

    public function checkPass(int $userId, string $userPass): string|bool
    {
        $userObj = $this->user->first('id', $userId);

        if (! empty($userObj) && property_exists($userObj, 'id')) {
            return password_verify($userPass, $userObj->password) ? 'true' : 0;
        }

        return false;
    }

    public function insertEvent(string $user, string $theme, string $description)
    {
        return $this->events->insert(['header' => $theme, 'description' => $description, 'created_by' => $user]);
    }
}
