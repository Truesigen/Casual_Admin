<?php

namespace App\Resources\Http;

class Request
{
    private array $properties = [];

    public function __construct()
    {
        $this->properties = $_REQUEST;
    }

    public function post(): array
    {
        $post = [];

        foreach ($_POST as $key => $value) {
            $post[$key] = $value;
        }

        return $post;
    }

    public function get(): array
    {
        $get = [];

        foreach ($_GET as $key => $value) {
            $get[$key] = $value;
        }

        return $get;
    }

    public function exists(string $key): bool
    {
        return isset($this->properties[$key]) ? 1 : 0;
    }

    public function __get(string $param): mixed
    {
        return $this->properties[$param] ?? null;
    }
}
