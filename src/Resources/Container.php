<?php

namespace App\Resources;

use App\Resources\Database\MysqlConnection;
use App\Resources\Database\RedisConnection;
use App\Resources\Http\Session;
use App\Resources\Http\Request;
use App\Resources\Http\Redirect;


class Container{

    public readonly MysqlConnection $mysql;

    public readonly \Redis $redis;

    public readonly Template $template;

    public readonly Validation $validation;

    public readonly Request $request;

    public readonly Redirect $redirect;

    public readonly Session $session;

    public function __construct()
    {   
        $this->db();
        $this->session = new Session();
        $this->redirect = new Redirect();
        $this->validation = new Validation();
        $this->template = new Template($this->session);
        $this->request = new Request($this->validation);
    }

    private function db(): void
    {
        if(!isset($this->mysql)){
            MysqlConnection::connect();
            $this->mysql = MysqlConnection::getInstance();
        }

        if(!isset($this->redis)){
            RedisConnection::connect();
            $this->redis = RedisConnection::getRedis();
        }
    }

}