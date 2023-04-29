<?php

declare(strict_types=1);

namespace CryptoScythe\Http\Generator;

use CryptoScythe\Http\Generator\WebConcept\Value;

final class MediaTypesRenderer implements RendererInterface
{
    public function renderHeadline(Value $value): string
    {
        return sprintf('Media type %s', $value->value);
    }

    public function renderConstWithContent(Value $value): string
    {
        return sprintf(
            "public const %s = '%s';",
            trim(
                strtoupper(preg_replace('/[^0-9A-z]/', '_', $value->value)),
                '_',
            ),
            $value->value,
        );
    }
}
