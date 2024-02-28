<?php

namespace Kernel\Resources\Http;

use Kernel\Resources\Helpers\Server;

class Response
{
    use Server;

    public function redirect(string $url = '/')
    {
        $this->sendHeader('Location:'.$url);
    }
}
