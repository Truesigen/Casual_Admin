<?php

namespace App\Controllers;

use Kernel\Resources\Controller;
use Kernel\Resources\Factories\EntityFactory;

class DefaultController extends Controller
{
    //route(/)
    public function index()
    {
        $this->assignPage(['events' => EntityFactory::make('event')->all()]);
    }

    //route(/logout)
    public function logout()
    {
        $this->session->unsetUserId();
        $this->redirect->redirect('/login');
    }
}
