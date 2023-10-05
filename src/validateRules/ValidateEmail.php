<?php

class ValidateEmail implements Validator
{
    public function validateRule($value)
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    public function getErrorMessage()
    {
        return 'Not valid email.';
    }
}
