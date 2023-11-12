<?php

namespace App\Controllers;

use App\Resourses\Controller;
use App\Services\PageService;

class DefaultController extends Controller
{
    public function default()
    {
        $this->assignPage(['events' => $this->events->findAll()]);
    }

    public function event()
    {
        if (isset($_SESSION['user_id'])) {
            $event = $this->events->first('id', intval($_GET['id']));
            $event->setValues(['user_id' => $_SESSION['user_id']]);
            $event->updateValues();
        }

        header('Location: /');
        exit;
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['is_admin']);
        header('Location: /login');
        exit;
    }

    private function service(): PageService
    {
        return new PageService($this->events);
    }
}
