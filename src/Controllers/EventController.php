<?php

namespace App\Controllers;

use App\Resources\Controller;

class EventController extends Controller
{
    public function runBeforeAction()
    {
        return true;
    }
}
