<?php

class ValidateMaximum implements Validator
{
    private $maximum;

    public function __construct($maximum)
    {
        $this->maximum = $maximum;
    }

    public function validateRule($value)
    {
        if (strlen($value) > $this->maximum) {
            return false;
        }

        return true;
    }

    public function getErrorMessage()
    {
        return 'Length is more than 20 characters';
    }
}
