<?php

namespace App\Controllers;

use App\Resourses\Controller;
use App\Services\PageService;

class DefaultController extends Controller
{
    public function default()
    {
        $events = $this->events->findAll();

        $this->assignPage('events', $events);
    }

    private function service()
    {
        return new PageService($this->events);
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        header('Location: /login');
        exit;
    }
}
