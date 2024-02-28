<?php

namespace App\Services;

use App\Models\User;
use Kernel\Resources\Factories\EntityFactory;

class AuthService
{
    private User $user;

    public function __construct()
    {
        $this->user = EntityFactory::make('User');
    }

    public function checkLogin(string $username, string $password): User|false
    {
        $userObj = $this->findUserByName($username);

        if (! empty($userObj) && password_verify($password, $userObj->password)) {
            return $userObj;
        } else {
            $_SESSION['auth_error'] = 'Wrong password or username.';

            return false;
        }

        return false;
    }

    public function registerNewUser(string $username, string $password): int|bool
    {
        $userCheck = $this->findUserByName($username);

        if (! empty($userCheck) && property_exists($userCheck, 'id')) {
            $_SESSION['auth_error'] = "$username already on board!";

            return false;
        }

        $success = $this->user
                            ->fill(['name' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)])
                            ->save();

        return $success;
    }

    private function findUserByName(string $name): User|false
    {
        $entity = $this->user->find('name', $name);

        return $entity ?? false;
    }
}
