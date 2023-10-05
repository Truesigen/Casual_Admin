<?php

class ValidateSpecialCharacters implements Validator
{
    private $rule;

    public function __construct($rule = '/[^a-zA-Z0-9]+/')
    {
        $this->rule = $rule;
    }

    public function validateRule($value)
    {
        if (! preg_match($this->rule, $value)) {
            return false;
        }

        return true;
    }

    public function getErrorMessage()
    {
        return 'There are no special characters in password.';
    }
}
