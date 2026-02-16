<?php

namespace Kernel\Resources;

use Kernel\Resources\Database\MysqlConnection;
use Kernel\Resources\Database\RedisConnection;
use Kernel\Resources\Http\Request;
use Kernel\Resources\Http\Response;
use Kernel\Resources\Http\Session;

class Container
{
    public readonly MysqlConnection $mysql;

    public readonly RedisConnection $redis;

    public readonly Validator $validator;

    public readonly Request $request;

    public readonly Response $response;

    public readonly Session $session;

    public readonly Template $template;

    public readonly Server $server;

    public function __construct(Server $server)
    {
        $this->server = $server;
        $this->response = new Response;
        $this->request = new Request($this->server->isApi());
        $this->validator = new Validator;
        if (! $this->server->isApi()) {
            $this->session = new Session;
            $this->template = new Template($this->session);
        }
    }

    public function db(): void
    {
        if (! isset($this->mysql)) {
            MysqlConnection::connect();
            $this->mysql = MysqlConnection::getInstance();
        }

        if (! isset($this->redis)) {
            // RedisConnection::connect();
            // $this->redis = RedisConnection::getRedis();
        }
    }

    public function makeController(string $controller): Controller
    {
        $object = new $controller;

        $object->setRequest($this->request);
        $object->setResponse($this->response);
        $object->setValidator($this->validator);
        $object->setSession($this->session ?? null);
        $object->setTemplate($this->template ?? null);

        return $object;
    }
}
