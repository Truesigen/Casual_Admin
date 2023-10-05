<?php

class ValidateMinimum implements Validator
{
    private $minimum;

    public function __construct($minimum)
    {
        $this->minimum = $minimum;
    }

    public function validateRule($value)
    {
        if (strlen($value) < $this->minimum) {
            return false;
        }

        return true;
    }

    public function getErrorMessage()
    {
        return 'Length is less than 3 characters';
    }
}
