<?php

namespace Kernel;

use Kernel\Resources\Container;

class AppStarter
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function run()
    {
        $app = $this->container->router->dispatch($this->container);
    }
}
