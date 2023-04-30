<?php

declare(strict_types=1);

namespace CryptoScythe\Http\Generator\Renderer;

use CryptoScythe\Http\Generator\ConstantNormalizer;
use CryptoScythe\Http\Generator\WebConcept\Value;

final class StatusCodeRenderer extends AbstractRenderer
{
    protected const HEADLINE_INTRO = 'Status code';

    public function renderConstWithContent(Value $value): string
    {

        $statusCodeConst = ConstantNormalizer::normalize($value->value);
        $statusMessageConst = ConstantNormalizer::normalize($value->description);

        return implode(
            str_pad("\n", 5, ' '),
            [
                sprintf(
                    'public const STATUS_%s = %s;',
                    $statusCodeConst,
                    $value->value,
                ),
                sprintf(
                    "public const MESSAGE_%s = '%s';",
                    $statusCodeConst,
                    str_replace('\'', '\\\'', $value->description),
                ),
                sprintf(
                    'public const STATUS_%s = self::STATUS_%s;',
                    $statusMessageConst,
                    $value->value,
                ),
                sprintf(
                    "public const MESSAGE_%s = self::MESSAGE_%s;",
                    $statusMessageConst,
                    $value->value,
                ),
            ]
        );
    }
}
