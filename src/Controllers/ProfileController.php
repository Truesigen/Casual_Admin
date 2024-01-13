<?php

namespace App\Controllers;

use App\Models\EntityFactory;
use App\Resources\Controller;

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
