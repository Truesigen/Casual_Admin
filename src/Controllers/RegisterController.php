<?php

namespace App\Controllers;

use App\Resourses\Controller;
use App\Services\AuthService;

class RegisterController extends Controller
{
    public function runBeforeAction()
    {
        if ($_POST) {
            $validation = $this->validation->addRule(['required', 'min', 'max', 'emptySpaces'])->validate(['name' => $_POST['name'], 'password' => $_POST['password']]);

            if (! $validation) {
                foreach ($this->validation->getAllErrors() as $key => $value) {
                    $_SESSION[$key] = $value;
                }
                header('Location: /register/new');
                exit;
            }

            $_POST['register_validation'] = 1;
        }

        return true;
    }

    public function register()
    {
        if ($_POST['register_validation'] ?? 0 == 1) {
            $this->service()->registerNewUser($_POST['name'], $_POST['password']);
        }

        $this->assignPage();
    }

    private function service(): AuthService
    {
        return new AuthService($this->user);
    }
}
