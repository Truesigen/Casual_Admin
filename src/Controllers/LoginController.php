<?php

namespace App\Controllers;

use App\Resourses\Controller;
use App\Services\AuthService;

class LoginController extends Controller
{
    public function runBeforeAction()
    {
        if (isset($_SESSION['user_id'])) {
            return false;
        }
        if ($_POST) {
            $data = $this->validation->addRule(['required', 'min', 'max', 'emptySpaces'])->validate(['name' => $_POST['name'], 'password' => $_POST['password']]);

            if (! $data) {
                foreach ($this->validation->getAllErrors() as $key => $error) {
                    $_SESSION[$key] = $error;
                }

                header('Location: /login');

                exit;
            }
            $_POST['success'] = 1;
        }

        return true;
    }

    public function login()
    {
        if ($_POST['success'] ?? 0 == 1) {
            $data = $this->service()->checkLogin($_POST['name'], $_POST['password']);
            if (is_int($data)) {
                $_SESSION['user_id'] = $data;

                header('Location: /');
                exit;
            }

            $_SESSION['auth_error'] = 'Wrong password or username';
        }

        $this->template->view('login');
    }

    private function service(): AuthService
    {
        return new AuthService($this->user);
    }
}