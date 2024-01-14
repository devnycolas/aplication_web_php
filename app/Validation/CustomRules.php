<?php

namespace App\Validation;

class CustomRules
{
    public function passwordMatches(string $password, string $field, array $data, string $error = null): bool
    {
        return isset($data[$field]) && $password === $data[$field];
    }
}
