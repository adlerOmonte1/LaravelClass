<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DniValido implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! preg_match('/^\d{8}$/', (string) $value)) {
            $fail('El :attribute debe tener exactamente 8 dígitos numéricos.');
            return;
        }

        if (preg_match('/^(\d)\1{7}$/', $value)) {        // 00000000, 11111111, ...
            $fail('El :attribute no puede tener todos sus dígitos iguales.');
        }
    }
}
