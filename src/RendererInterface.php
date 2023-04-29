<?php

declare(strict_types=1);

namespace CryptoScythe\Http\Generator;

use CryptoScythe\Http\Generator\WebConcept\Value;

interface RendererInterface
{
    public function renderHeadline(Value $value): string;

    public function renderConstWithContent(Value $value): string;
}
