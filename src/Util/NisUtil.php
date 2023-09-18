<?php

namespace App\Util;

// O Pis/Nis/Pasep é um número de identificação social,
// que serve para identificar o trabalhador brasileiro.
// Ele é utilizado para identificar os trabalhadores brasileiros,
// sendo um número único para cada trabalhador.

// O número do PIS é composto por 11 dígitos,
// sendo que o último dígito é um verificador.
// Portante: 10 dígitos + 1 dígito verificador.
// NNN.NNNN.NNN-D

//O cálculo do dígito verificador é feito da seguinte forma:

// 1. Multiplica-se os 10 digitos (N) do NIS por pesos que variam de 2 a 9,
// na seguinte ordem: 3,2,9,8,7,6,5,4,3,2.

// 2. Soma-se o resultado das multiplicações.
// Cálculo: S = N1*3 + N2*2 + N3*9 + N4*8 + N5*7 + N6*6 + N7*5 + N8*4 + N9*3 + N10*2

// 3. Divide-se o resultado da soma por 11.
// Cálculo: Divisão = Soma / 11

// 4. Se o resto da divisão for igual a 0 ou 1, o dígito verificador será 0.
// Caso contrário, o dígito verificador é a subtração de 11 pelo resto da divisão.
// Cálculo: Dígito = 11 - (Soma % 11)

class NisUtil
{
    public static function generateNis(): int
    {
        $base = self::generateBase();
        $base .= self::calculateDigit($base);
        return (int) $base;
    }

    public static function validateNis($nis): bool
    {
        try {
            if (strlen($nis) !== 11) {
                return false;
            }

            $base = substr($nis, 0, 10);
            $digit = self::calculateDigit($base);

            return $nis[10] == $digit;
        } catch (\Throwable $th) {
            return false;
        }

    }

    //Função que calcula o dígito verificador
    private static function calculateDigit($base): int
    {
        $sum = 0;
        $weights = [3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for ($i = 0; $i < 10; $i++) {
            $sum += $base[$i] * $weights[$i];
        }

        $remainder = $sum % 11;

        if ($remainder < 2) {
            return 0;
        } else {
            return 11 - $remainder;
        }
    }

    private static function generateBase(): string
    {
        return str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
    }
}
