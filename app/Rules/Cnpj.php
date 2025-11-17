<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cnpj implements Rule
{
    public function passes($attribute, $value)
    {
        $cnpj = preg_replace('/\D/', '', $value);
        if (strlen($cnpj) != 14) return false;
        if (preg_match('/^(\\d)\\1*$/', $cnpj)) return false;

        $lengths = [5,6];
        $numbers = substr($cnpj,0,12);

        for ($t = 0; $t < 2; $t++) {
            $sum = 0;
            for ($i = 0, $p = $lengths[$t]; $i < strlen($numbers); $i++) {
                $sum += $numbers[$i] * $p;
                $p = ($p == 2) ? 9 : $p - 1;
            }
            $res = $sum % 11;
            $digit = ($res < 2) ? 0 : 11 - $res;
            $numbers .= $digit;
        }

        return $numbers === $cnpj;
    }

    public function message()
    {
        return 'O CNPJ informado é inválido.';
    }
}
