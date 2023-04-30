<?php

namespace CryptoScythe\Http\Generator\Renderer;

use CryptoScythe\Http\Generator\ConstantNormalizer;
use CryptoScythe\Http\Generator\WebConcept\Value;

abstract class AbstractRenderer implements RendererInterface
{
    /** @var string */
    protected const HEADLINE_INTRO = '';

    public function renderHeadline(Value $value): string
    {
        return trim(sprintf('%s %s', static::HEADLINE_INTRO, $value->value));
    }

    public function renderConstWithContent(Value $value): string
    {
        return sprintf(
            "public const %s = '%s';",
            ConstantNormalizer::normalize($value->value),
            $value->value,
        );
    }
}
