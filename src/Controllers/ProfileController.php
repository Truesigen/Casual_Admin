<?php

namespace App\Controllers;

use App\Resourses\Controller;

class ProfileController extends Controller
{
    public function runBeforeAction()
    {
        if (empty($_SESSION['user_id'])) {
            $this->assignPage();

            return;
        }

        return true;
    }

    public function index()
    {
        $this->assignPage([
            'user' => $this->user->first('id', $_SESSION['user_id']),
        ]);
    }

    public function newAvatar()
    {
        if ($_GET['avatar'] ?? 0 == 1) {
            $userObj = $this->user->first('id', $_SESSION['user_id']);
            $userObj->setValues(['avatar' => $_GET['avatar']]);
            $userObj->updateValues();
            $this->assignPage(['user' => $userObj]);
        }
    }
}
