<?php

namespace App\Validation;

use CodeIgniter\Validation\Rules;

class CustomValidation extends Rules
{
    public function strong_password(string $str, array $data = null): bool
    {
        // Verifica se a senha contém pelo menos um número e um caractere especial
        return (bool) preg_match('/[0-9]+.*[!@#$%^&*(),.?":{}|<>]+|[!@#$%^&*(),.?":{}|<>]+.*[0-9]+/', $str);
    }
}
