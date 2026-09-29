<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class DniValido implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^\d{8}$/', (string) $value)) {
            $fail('El :attribute debe contener exactamente 8 dígitos numericos.');
            return;
        }

        if (preg_match('/^(\d)\1{7}$/', $value)) {
            $fail('El :attribute no es valido: no puede tener los 8 dígitos iguales.');
        }

    }
}
