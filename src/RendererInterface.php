<?php

declare(strict_types=1);

namespace CryptoScythe\Http\Generator;

use CryptoScythe\Http\Generator\WebConcept\Value;

interface RendererInterface
{
    public function renderConstWithContent(Value $value, $indentation = 4): string;
}
