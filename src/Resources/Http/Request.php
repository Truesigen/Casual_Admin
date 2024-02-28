<?php

namespace Kernel\Resources\Http;

use Kernel\Resources\Helpers\Server;

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
        $this->properties = $this->headerHas('CONTENT_TYPE') == 'application/json' ? json_decode(file_get_contents('php://input'), true) : $_REQUEST;
    }

    public function __get(string $param): mixed
    {
        return $this->properties[$param] ?? null;
    }

    public static function make()
    {
        return new static();
    }
}
