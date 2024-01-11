<?php

namespace App\Controllers;

use App\Models\EntityFactory;
use App\Resources\Controller;
use App\Services\PageService;

class DefaultController extends Controller
{
    public function default()
    {
        $this->assignPage(['events' => EntityFactory::make('event')->all()]);
    }

    public function event()
    {
        if (isset($_SESSION['user_id'])) {
            $event = EntityFactory::make('Event')->first('id', intval($_GET['id']));
            $event->setValues(['user_id' => $_SESSION['user_id']]);
            $event->updateValues();
        }

        header('Location: /');
        exit;
    }

    public function logout()
    {
        $this->session->unsetUserId();
        $this->redirect->redirect('/login');
    }

    private function service(): PageService
    {
        return new PageService(EntityFactory::make('Event'));
    }
}
