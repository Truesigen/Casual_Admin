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

    public function checkLogin(string $username, string $password): EntityInterface|false
    {
        $userObj = $this->user->first('name', $username);

        if (! empty($userObj) && property_exists($userObj, 'id')) {
            return password_verify($password, $userObj->password) ? $userObj : false;
        }

        return false;
    }

    public function registerNewUser(string $username, string $password): int|bool
    {
        $success = $this->user->insert(['name' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

        if (empty($success)) {
            $_SESSION['auth_error'] = "$username already on board!";
        }

        return $success;
    }
}
