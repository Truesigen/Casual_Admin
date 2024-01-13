<?php

namespace App\Controllers;

use App\Models\EntityFactory;
use App\Resources\Controller;

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
