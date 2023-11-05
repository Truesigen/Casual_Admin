<?php

namespace App\Resourses;

class Validation
{
    private $rules;

    private $errors = [];

    public function addRule($rule)
    {
        $this->rules = $rule;

        return $this;
    }

    public function validate($value)
    {
        //dd($this->rules);
        foreach ($this->rules as $rule) {
            $error = match ($rule) {
                'required' => empty($value) ? 'input is required' : true,
                'min' => mb_strlen($value) < 3 ? 'input must be more than 3 characters' : true,
                'max' => mb_strlen($value) > 255 ? 'input must be less than 255 characters' : true,
                'emptySpaces' => str_contains($value, ' ') ? 'Input must be without empty spaces' : true,
                default => 'unknown'
            };
            $this->errors[$rule] = $error;
        }

        dd($this->errors);

        /**foreach ($this->rules as $item) {
            $ruleValidation = $item->validateRule($value);
            if (! $ruleValidation) {
                $this->errorMessages[] = $item->getErrorMessage();

                return false;
            }
        }

        return true; */
    }

        public function getAllError()
        {
            return $this->errorMessages;
        }

        public function unsetRules()
        {
            unset($this->rules);
            unset($this->errorMessages);
        }
}
