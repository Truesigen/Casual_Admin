<?php

namespace App\Controllers;

use App\Models\EntityFactory;
use App\Resourses\Controller;

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
            'user' => EntityFactory::make('User')->first('id', $_SESSION['user_id']),
        ]);
    }

    public function newAvatar()
    {
        if ($_GET['avatar'] ?? 0 == 1) {
            $userObj = EntityFactory::make('User')->first('id', $_SESSION['user_id']);
            $userObj->setValues(['avatar' => $_GET['avatar']]);
            $userObj->updateValues();
            $this->assignPage(['user' => $userObj]);
        }
    }
}
