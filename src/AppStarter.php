<?php

namespace Kernel;

use Kernel\Resources\Container;
use Kernel\Resources\Routing\Router;
use Kernel\Resources\Server;

class AppStarter
{
    private Container $container;

    private Router $router;

    private Server $server;

    public function __construct()
    {
        $this->server = new Server;
        $this->container = new Container($this->server);
        $this->router = new Router($this->container);
    }

    public function run(): void
    {
        $source = $this->server->identifyRequest();
        $this->container->db();
        $this->router->dispatch($source);

    }
}
