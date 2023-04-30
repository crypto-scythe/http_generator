<?php

namespace CryptoScythe\Http\Generator;

final class ConstantNormalizer
{
    public static function normalize(string $constant): string
    {
        return trim(
            strtoupper(preg_replace('/[^0-9A-z]/', '_', $constant)),
            '_',
        );
    }
}
