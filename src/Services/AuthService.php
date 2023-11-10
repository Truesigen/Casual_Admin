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

        if (! empty($userObj) && property_exists($userObj, 'id')) {
            return password_verify($password, $userObj->password) ? $userObj->id : false;
        }

        return false;
    }

    public function registerNewUser($username, $password): int|bool
    {
        $success = $this->user->insert(['name' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

        if (empty($success)) {
            $_SESSION['auth_error'] = 'Unknown issue.';
        }

        return $success;
    }
}
