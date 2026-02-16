<?php

namespace Kernel\Resources\Http;

use AllowDynamicProperties;

#[AllowDynamicProperties]
class Request
{
    public array $queryString;

    public array $input = [];

    public function __construct(bool $apiRequest)
    {
        $this->setInput($apiRequest);
    }

    public function has(string $key): bool
    {
        return isset($this->input[$key]);
    }

    private function setInput(bool $apiRequest)
    {

        $this->queryString = $_GET;
        $input = $apiRequest ? json_decode(file_get_contents('php://input'), true) : $_POST;

        if (isset($input) && ! empty($input)) {

            foreach ($input as $key => $value) {
                $this->$key = $value;
                $this->input[$key] = $value;
            }
        }
    }

    public function input()
    {
        return $this->input;
    }
}
