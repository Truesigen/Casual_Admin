<?php
/**
 * Validation class, created with Dependency inversion pattern.
 */
class Validation
{
    private $rules;

    private $errorMessages = [];

    public function addRule(Validator $rule)
    {
        $this->rules[] = $rule;

        return $this;
    }

    public function validate($value)
    {
        foreach ($this->rules as $item) {
            $ruleValidation = $item->validateRule($value);
            if (! $ruleValidation) {
                $this->errorMessages[] = $item->getErrorMessage();

                return false;
            }
        }

        return true;
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
