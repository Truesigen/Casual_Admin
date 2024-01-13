<?php

namespace App\Controllers;

use App\Resources\Controller;
use App\Resources\Http\Request;
use App\Services\AuthService;

class LoginController extends Controller
{
    public function runBeforeAction()
    {
        if ($this->session->has('user_id')) {
            $this->redirect->redirect('/');
        }

        return true;
    }

    //route(/login)
    public function index()
    {
        $this->assignPage();
    }

    //route(/sign-in)
    public function login(Request $request)
    {
        $login = $this->validation->addRule(['required', 'min', 'max', 'emptySpaces'])->validate($request->post());

        if (! $login) {
            $this->session->setErrors($this->validation->getAllErrors());
            $this->redirect->redirect('/login');
        }

        $user = $this->service()->checkLogin($request->name, $request->password);

        if (! $user) {
            $this->redirect->redirect('/login');
        }

        $_SESSION['user_id'] = $user->id;

        $this->redirect->redirect('/');
    }

    private function service(): AuthService
    {
        return new AuthService();
    }
}
