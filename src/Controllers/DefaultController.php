<?php

namespace App\Controllers;

use App\Resourses\Controller;

class DefaultController extends Controller
{
    public function default()
    {
        //dd($this->page->first('id', $this->entityId));

        $this->template->view('default');
    }
}
