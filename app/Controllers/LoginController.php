<?php

namespace App\Controllers;

use App\Services\AuthService;
use Kernel\Resources\Controller;
use Kernel\Resources\Http\Request;

class LoginController extends Controller
{
    public function runBeforeAction()
    {
        if ($this->session->has('user_id')) {
            $this->response->redirect('/');
        }

        return true;
    }

    //route(/login)
    public function index()
    {
        $this->assignPage();
    }

    //route(/sign-in)
    public function login()
    {
        $request = Request::make();
        $login = $this->validation->addRule(['required', 'min', 'max', 'emptySpaces'])->validate($request->all());

        if (! $login) {
            $this->session->setErrors($this->validation->getAllErrors());

            $this->response->redirect('/login');
        }

        $user = $this->service()->checkLogin($request->name, $request->password);

        if (! $user) {
            $this->response->redirect('/login');
        }

        $_SESSION['user_id'] = $user->id;

        $this->response->redirect('/');
    }

    private function service(): AuthService
    {
        return new AuthService();
    }
}
