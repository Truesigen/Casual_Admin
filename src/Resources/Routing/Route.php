<?php

namespace Kernel\Resources\Routing;

class Route
{
    private string $url;

    private string $method;

    private array $controller;

    public function __construct($url, $method, $controller = [])
    {
        $this->url = $url;
        $this->method = $method;
        $this->controller = $controller;
    }

    public function url()
    {
        return $this->url;
    }

    public function method()
    {
        return $this->method;
    }

    public function controller()
    {
        return $this->controller;
    }

    public static function create($url, $method, $controller)
    {
        return new static($url, $method, $controller);
    }
}
