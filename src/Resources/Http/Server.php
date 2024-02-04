<?php

namespace Kernel\Resources\Http;

trait Server
{
    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function uri(): string
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');

        return $uri;
    }

    public function headerHas(string $key): string|false
    {
        return $_SERVER[$key] ?? false;
    }

    public function sendHeader(string $raw)
    {
        header($raw);
        exit;
    }
}
