<?php

namespace App\Services;

use App\Resourses\EntityInterface;

class AuthService
{
    private EntityInterface $user;

    public function __construct(EntityInterface $user)
    {
        $this->user = $user;
    }

    public function checkLogin(string $username, string $password): int|false
    {
        $userObj = $this->user->first('name', $username);

        if (property_exists($userObj, 'id')) {
            return password_verify($password, $userObj->password) ? $userObj->id : false;
        }

        return false;
    }

    public function changeUserPassword($userObj, $newPassword)
    {
        $userObj->password = password_hash($newPassword, PASSWORD_DEFAULT);

        return $userObj;
    }
}
