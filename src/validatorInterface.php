<?php

interface Validator
{
    public function validateRule($value);

    public function getErrorMessage();
}
