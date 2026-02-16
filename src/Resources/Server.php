<?php

namespace Kernel\Resources;

class Server
{
    public function identifyRequest()
    {
        $source = ['web', $this->method(), $this->uri()];

        if ($this->isApi()) {
            header('Content-Type: application/json');

            $source = ['api', $this->method(), substr($this->uri(), strlen('/api'))];
        }

        return $source;
    }

    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isApi()
    {
        if (str_starts_with($this->uri(), '/api/')) {

            return true;
        }

        return false;
    }

    public function wantsJson(): bool
    {
        if (isset($_SERVER['HTTP_ACCEPT']) && $_SERVER['HTTP_ACCEPT'] == 'application/json') {
            return true;
        }

        return false;
    }

    public function uri()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $uri = htmlspecialchars($uri);
        $uri = filter_var($uri, FILTER_SANITIZE_URL);
        $uri = $uri != '/' ? rtrim($uri, '/') : '/';

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
