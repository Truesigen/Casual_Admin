<?php

namespace Kernel\Resources;

class Validator
{
    private array $rules;

    private array $errors = [];

    public function addRules(array $rule): Validator
    {
        $this->rules = $rule;

        return $this;
    }

    public function validate(array $input): Validator
    {

        foreach ($this->rules as $key => $value) {

            $currentRule = explode('|', $value);

            foreach ($currentRule as $rule) {

                if (array_key_exists($key, $input)) {

                    $currentValue = $input[$key];

                    $error = match ($rule) {
                        'nullable' => empty($currentValue) || is_null($currentValue) ?: 1,
                        'required' => empty($currentValue) || ! isset($currentValue) ? "{$key} is required" : 1,
                        'min' => isset($currentValue) && mb_strlen($currentValue) < 3 ? "{$key} must be more than 3 characters" : 1,
                        'max' => isset($currentValue) && mb_strlen($currentValue) > 255 ? "{$key} must be less than 255 characters" : 1,
                        'emptySpaces' => str_contains($currentValue, ' ') ? "{$key} must be without empty spaces" : 1,
                        'date' => ! is_string($currentValue) || strtotime($currentValue) == false ? "{$key} must be in valid date format Y-m-d H:i:s" : 1,
                        default => 'unknown problem'
                    };

                    if ($error != 1) {
                        $this->errors[$key][] = $error;
                    }
                }
            }

            if (in_array('nullable', $currentRule, true) && ! isset($input[$key])) {
                unset($this->errors[$key]);
            }

        }

        return $this;
    }

    public function getErrors(): array
    {
        $errors = $this->errors;
        $this->unsetRules();

        return $errors;

    }

    public function hasErrors()
    {
        return isset($this->errors) && ! empty($this->errors);
    }

    public function unsetRules()
    {
        unset($this->rules);
        unset($this->errors);
    }
}
