<?php

namespace Kernel\Resources\Http;

class Response
{
    use Server;

    public function redirect(string $url = '/')
    {
        $this->sendHeader('Location'.$url);
    }
}
