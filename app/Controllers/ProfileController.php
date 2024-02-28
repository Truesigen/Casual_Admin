<?php

namespace App\Controllers;

use Kernel\Resources\Controller;
use Kernel\Resources\Factories\EntityFactory;

class ProfileController extends Controller
{
    public function runBeforeAction()
    {
        if (empty($_SESSION['user_id'])) {
            $this->assignPage();

            return false;
        }

        return true;
    }

    public function index()
    {
        $this->assignPage([
            'user' => EntityFactory::make('User')->find('id', $_SESSION['user_id']),
        ]);
    }
}
