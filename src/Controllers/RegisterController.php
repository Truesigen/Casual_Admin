<?php

namespace App\Controllers;

use App\Resourses\Controller;

class RegisterController extends Controller
{
    public function register()
    {
        $this->template->view('register');
    }
}
