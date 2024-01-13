<?php

namespace App\Controllers;

use App\Resources\Controller;
use App\Resources\Http\Request;
use App\Services\AuthService;

class RegisterController extends Controller
{
    public function runBeforeAction()
    {
        if ($this->session->has('user_id')) {
            $this->redirect->redirect('/');
        }

        return true;
    }

    //route(/register-new-user)
    public function index()
    {
        $this->assignPage();
    }

    //route(/register)
    public function register(Request $request)
    {
        $validation = $this->validation->addRule(['required', 'min', 'max', 'emptySpaces'])->validate($request->post());

        if (! $validation) {
            $this->session->setErrors($this->validation->getAllErrors());
            $this->redirect->redirect('/register-new-user');
        }

        $registration = $this->service()->registerNewUser($request->name, $request->password);

        if (! $registration) {
            $this->redirect->redirect('/register-new-user');
        }

        $this->redirect->redirect('/login');
    }

    private function service(): AuthService
    {
        return new AuthService();
    }
}
