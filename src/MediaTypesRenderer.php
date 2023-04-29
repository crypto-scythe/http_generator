<?php

declare(strict_types=1);

namespace CryptoScythe\Http\Generator;

use CryptoScythe\Http\Generator\WebConcept\Value;

final class MediaTypesRenderer implements RendererInterface
{
    public function renderConstWithContent(Value $value, $indentation = 4): string
    {
        return sprintf(
            "public const %s = '%s';",
            trim(
                strtoupper(preg_replace('/[^0-9A-z]/', '_', $value->value())),
                '_',
            ),
            $value->value(),
        );
    }
}
