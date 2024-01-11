<?php

namespace App\Resources\Http;

class Redirect
{
    public function redirect(string $url = '/')
    {
        header("Location: $url");
        exit;
    }

    public function withInput(array $input)
    {
        foreach ($input as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }
}
