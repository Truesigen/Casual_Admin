<?php

namespace Kernel\Resources\Routing;

class Route
{
    public function __construct(private string $url, private string $method, private array $controller) {}

    public function url(): string
    {
        $regex = str_replace('{id}', '(\d+)', $this->url);
        $regex = '#^'.$regex.'$#';

        return $regex;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function controller(): array
    {
        return $this->controller;
    }

    public static function get(string $url, array $controller): Route
    {
        return new self($url, 'GET', $controller);
    }

    public static function post(string $url, array $controller): Route
    {
        return new self($url, 'POST', $controller);
    }

    public static function patch(string $url, array $controller): Route
    {
        return new self($url, 'PATCH', $controller);
    }

    public static function delete(string $url, array $controller): Route
    {
        return new self($url, 'DELETE', $controller);
    }

    public static function put(string $url, array $controller): Route
    {
        return new self($url, 'PUT', $controller);
    }
}
