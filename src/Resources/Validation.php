<?php

namespace Kernel\Resources;

class Validation
{
    private $rules;

    private $errors = [];

    public function addRule(array $rule): Validation
    {
        $this->rules = $rule;

        return $this;
    }

    public function validate(array $values): bool
    {
        foreach ($this->rules as $rule) {
            foreach ($values as $key => $value) {
                $error = match ($rule) {
                    'required' => empty($value) ? 'input is required' : 1,
                    'min' => mb_strlen($value) < 3 ? 'input must be more than 3 characters' : 1,
                    'max' => mb_strlen($value) > 255 ? 'input must be less than 255 characters' : 1,
                    'emptySpaces' => str_contains($value, ' ') ? 'Input must be without empty spaces' : 1,
                    default => 'unknown'
                };

                if ($error != 1) {
                    $this->errors[$key][] = $error;
                }
            }
        }

        return empty($this->errors);
    }

    public function getAllErrors(): array
    {
        return $this->errors;
    }

    public function unsetRules()
    {
        unset($this->rules);
        unset($this->errors);
    }
}
