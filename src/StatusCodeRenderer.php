<?php

declare(strict_types=1);

namespace CryptoScythe\Http\Generator;

use CryptoScythe\Http\Generator\WebConcept\Value;

final class StatusCodeRenderer implements RendererInterface
{
    public function renderConstWithContent(Value $value, $indentation = 4): string
    {

        $statusCodeConst = trim(
            strtoupper(preg_replace('/[^0-9A-z]/', '_', $value->value())),
            '_',
        );
        $statusMessageConst = trim(
            strtoupper(preg_replace('/[^0-9A-z]/', '_', $value->description())),
            '_',
        );

        return join(
            str_pad("\n", $indentation + 1, ' '),
            [
                sprintf(
                    'public const STATUS_%s = %s;',
                    $statusCodeConst,
                    $value->value(),
                ),
                sprintf(
                    "public const MESSAGE_%s = '%s';",
                    $statusCodeConst,
                    str_replace('\'', '\\\'', $value->description()),
                ),
                sprintf(
                    'public const STATUS_%s = self::STATUS_%s;',
                    $statusMessageConst,
                    $value->value(),
                ),
                sprintf(
                    "public const MESSAGE_%s = self::MESSAGE_%s;",
                    $statusMessageConst,
                    $value->value(),
                ),
            ]
        );
    }
}
