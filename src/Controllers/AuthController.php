<?php

namespace App\Controllers;

use App\Resourses\Controller;

class AuthController extends Controller
{
    public function login()
    {
        $this->validation->addRule(['required', 'min', 'max', 'emptySpaces'])->validate('zxs');
        $this->template->view('login', []);
    }
}
