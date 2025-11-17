<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cpf implements Rule
{
    public function passes($attribute, $value)
    {
        $cpf = preg_replace('/\D/', '', $value);

        if (strlen($cpf) != 11) return false;

        if (preg_match('/^(\\d)\\1{10}$/', $cpf)) return false;

        for ($t = 9; $t < 11; $t++) {
            $sum = 0;
            for ($i = 0; $i < $t; $i++) {
                $sum += $cpf[$i] * (($t + 1) - $i);
            }

            $digit = (($sum * 10) % 11) % 10;

            if ($cpf[$t] != $digit) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'O CPF informado é inválido.';
    }
}
