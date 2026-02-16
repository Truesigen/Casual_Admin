<?php

namespace Kernel\Resources\Routing;

use Kernel\Resources\Container;
use Kernel\Resources\Exceptions\RouteNotFoundException;

class Router
{
    public function __construct(public readonly Container $container) {}

    public function dispatch(array $source)
    {
        [$route, $id] = $this->getRoute($source);

        [$controller, $action] = $route->controller();

        $controller = $this->container->makeController($controller);

        call_user_func([$controller, 'runAction'], [$action, $id]);
    }

    public function getRoute(array $source)
    {
        $routes = require ROOT_PATH.'/src/routes/routes.php';

        [$http, $method, $url] = $source;

        if (array_key_exists($method, $routes[$http])) {
            $routes = $routes[$http][$method];

            foreach ($routes as $route) {
                if (preg_match($route->url(), $url, $matched)) {
                    $id = $matched[1] ?? null;

                    return [$route, $id];
                }
            }
        }

        throw new RouteNotFoundException;
    }
}
