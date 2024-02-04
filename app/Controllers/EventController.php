<?php

namespace App\Controllers;

use Kernel\Resources\Controller;

class EventController extends Controller
{
    public function runBeforeAction()
    {
        return true;
    }
}
