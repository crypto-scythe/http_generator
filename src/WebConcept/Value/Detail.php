<?php

declare(strict_types=1);

namespace CryptoScythe\Http\Generator\WebConcept\Value;

use CryptoScythe\Http\Generator\WebConcept\Value\Detail\Description;

final class Detail
{
    public readonly Description $description;

    public readonly string $documentation;

    public readonly string $specification;

    public function __construct(array $data)
    {
        $this->description = new Description((string) ($data['description'] ?? ''));
        $this->documentation = (string) ($data['documentation'] ?? '');
        $this->specification = (string) ($data['specification'] ?? '');
    }
}
