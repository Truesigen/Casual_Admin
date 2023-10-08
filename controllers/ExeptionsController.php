<?php

class Exeptions extends Controller
{
    public function defaultAction()
    {
        $this->template->view('status/404', []);
    }
}
