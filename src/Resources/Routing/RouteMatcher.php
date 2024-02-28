<?php

namespace Kernel\Resources\Routing;

class RouteMatcher
{
    public bool $equels = false;

    public $route = null;

    public $queryParam = null;

    public function matchMaking(array $routes, string $requestUri): RouteMatcher
    {
        foreach ($routes as $route) {
            $this->findEquels($route->url(), $requestUri);

            if ($this->equels == true) {
                $this->route = $route;
                break;
            }
        }

        return $this;
    }

    private function findEquels(string $routeUrl, string $requestUri): void
    {
        $arrayRouteUrl = explode('/', $this->clean($routeUrl));
        $arrayRequestUri = explode('/', $this->clean($requestUri));

        $requiredMatches = count($arrayRouteUrl);

        if ($requiredMatches == count($arrayRequestUri)) {
            $arrayOfEquels = [];

            foreach ($arrayRouteUrl as $key => $value) {
                if (preg_match('/{.*}/', $value) && preg_match('/^\d+$/', $arrayRequestUri[$key])) {
                    $arrayOfEquels[] = true;
                    $this->queryParam = $arrayRequestUri[$key];

                    continue;
                }

                $arrayOfEquels[] = $arrayRequestUri[$key] == $value ? true : false;
            }

            if ($requiredMatches == $this->countEquels($arrayOfEquels)) {
                $this->equels = true;
            }
        }
    }

    private function countEquels(array $equels): int
    {
        $count = 0;

        foreach ($equels as $value) {
            if ($value == true) {
                $count += 1;
            }
        }

        return $count;
    }

    private function clean(string $url): string
    {
        return preg_replace('/(^\/)|(\/$)/', '', $url);
    }
}
