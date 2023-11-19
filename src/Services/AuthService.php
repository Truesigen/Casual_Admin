<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function checkLogin(string $username, string $password): User|false
    {
        $userObj = $this->user->first('name', $username);

        if (! empty($userObj) && property_exists($userObj, 'id')) {
            return password_verify($password, $userObj->password) ? $userObj : false;
        }

        return false;
    }

    public function registerNewUser(string $username, string $password): int|bool
    {
        $userCheck = $this->user->first('name', $username);

        if (empty($userCheck)) {
            $success = $this->user->insert(['name' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

            return $success;
        }

        $_SESSION['auth_error'] = "$username already on board!";

        return false;
    }
}
