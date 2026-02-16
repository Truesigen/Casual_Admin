<?php

namespace Kernel\Resources\Http;

class Session
{
    public function __construct()
    {
        session_start([]);
    }

    public function seeErrors(string $key): void
    {
        if (isset($_SESSION[$key])) {
            echo is_string($_SESSION[$key]) ? $_SESSION[$key] : $_SESSION[$key][0];

            unset($_SESSION[$key]);
        }
    }

    public function setErrors(array $errors): void
    {
        foreach ($errors as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    public function old(string $field, $default = ''): void
    {
        $old = $_SESSION[$field] ?? $default;

        echo $old;

        unset($_SESSION[$field]);
    }

    public function has(string $field): bool
    {
        return isset($_SESSION[$field]);
    }

    public function unsetUserId()
    {
        unset($_SESSION['user_id']);
    }
}
