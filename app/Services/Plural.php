<?php

namespace App\Services;

class Plural
{
    public static function make(int $number, string $one, string $few, string $many): string
    {
        $number = abs($number) % 100;
        $lastDigit = $number % 10;

        if ($number > 10 && $number < 20) {
            return $many;
        }

        if ($lastDigit > 1 && $lastDigit < 5) {
            return $few;
        }

        if ($lastDigit === 1) {
            return $one;
        }

        return $many;
    }
}