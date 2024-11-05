<?php

namespace App;

class Validator
{
    private array $rules = [];

    public function addRule(string $field, string $rule): void
    {
        if (!in_array($rule, $this->rules[$field])) {
            $this->rules[$field][] = $rule;
        }
    }

    public function validate(array $form): array
    {
        $errors = [];
        foreach ($this->rules as $field => $rule) {
            foreach ($rule as $r) {
                if ($r === 'required' && !isset($form[$field])) {
                    $errors[$field] = 'Field is required';
                }
            }
        }
        return $errors;
    }
}
