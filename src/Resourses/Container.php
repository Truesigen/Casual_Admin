<?php

namespace App\Resourses;


class Container{

    public readonly DatabaseConnection $db;

    public readonly Template $template;

    public readonly Validation $validation;

    public function __construct()
    {   
        $this->db();
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