<?php

namespace Kernel\Resources\Routing;

use Kernel\Resources\Container;
use Kernel\Resources\Helpers\ConfigurationMaster;
use Kernel\Resources\Helpers\Server;

class Router
{
    use Server;

    private RouteMatcher $matcher;

    public function __construct()
    {
        $this->matcher = new RouteMatcher;
    }

    public function dispatch(Container $container)
    {
        $routes = $this->getRoutes();

        $matcher = $this->matcher->matchMaking($routes, $this->uri());

        if (! $matcher->equels) {
            echo 'not found';
            http_response_code(404);
            exit;
        }

        [$controller, $action] = $matcher->route->controller();

        $controller = new $controller($container);

        call_user_func([$controller, 'runAction'], [$action, $matcher->queryParam]);
    }

    private function getRoutes()
    {
        $path = 'routes.web.'.$this->method();

        return ConfigurationMaster::get($path);
    }
}
