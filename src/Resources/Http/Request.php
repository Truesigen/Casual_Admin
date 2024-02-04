<?php

namespace Kernel\Resources\Http;

class Request
{
    use Server;

    private array $properties = [];

    public function __construct()
    {
        $this->setInput();
    }

   public function all(): array
   {
       return $this->properties;
   }

    public function has(string $key): bool
    {
        return isset($this->properties[$key]);
    }

    private function setInput()
    {
        $this->properties = $this->headerHas('CONTENT_TYPE') == 'application/json' ? json_decode(file_get_contents('php://input'), true) : $_POST;
    }

    public function __get(string $param): mixed
    {
        return $_GET[$param] ?? null;
    }

    public static function make()
    {
        return new static();
    }
}
