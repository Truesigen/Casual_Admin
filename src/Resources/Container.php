<?php

namespace Kernel\Resources;

use Kernel\Resources\Database\MysqlConnection;
use Kernel\Resources\Database\RedisConnection;
use Kernel\Resources\Http\Session;
use Kernel\Resources\Http\Request;
use Kernel\Resources\Http\Response;
use Kernel\Resources\Routing\Router;



class Container{

    public readonly MysqlConnection $mysql;

    public readonly \Redis $redis;

    public readonly Template $template;

    public readonly Validation $validation;

    public readonly Request $request;

    public readonly Response $response;

    public readonly Session $session;

    public readonly Router $router;

    public function __construct()
    {   
        $this->db();
        $this->response = new Response();
        $this->request = new Request();
        $this->session = new Session();
        $this->router = new Router();
        $this->template = new Template($this->session);
        $this->validation = new Validation();
    }

    private function db(): void
    {
        if(!isset($this->mysql)){
            MysqlConnection::connect();
            $this->mysql = MysqlConnection::getInstance();
        }

        if(!isset($this->redis)){
            //RedisConnection::connect();
            //$this->redis = RedisConnection::getRedis();
        }
    }

}