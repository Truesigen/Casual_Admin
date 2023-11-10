<?php

namespace App\Resourses;

use App\Models\Page;
use App\Models\Routes;
use App\Models\User;
use App\Models\Event;

class Container{
    public readonly EntityInterface $page;

    public readonly EntityInterface $events;

    public readonly EntityInterface $routes;

    public readonly EntityInterface $user;

    public readonly DatabaseConnection $db;

    public readonly Template $template;

    public readonly Validation $validation;

    function __construct()
    {
        $this->db();
        $this->page = new Page($this->db->getConnection());
        $this->routes = new Routes($this->db->getConnection());
        $this->user = new User($this->db->getConnection());
        $this->events = new Event($this->db->getConnection());
        $this->template = new Template();
        $this->validation = new Validation();   
    }

    private function db(): void
    {
        if(!isset($this->db)){
            DatabaseConnection::connect();
            $this->db = DatabaseConnection::getInstance();
        }
    }

}