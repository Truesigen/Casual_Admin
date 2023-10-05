<?php

class ValidateNoEmptySpaces implements Validator
{
    public function validateRule($value)
    {
        if (strpos($value, ' ') === false) {
            return true;
        }

        return false;
    }

    public function getErrorMessage()
    {
        return 'No empty spaces allowed.';
    }
}
