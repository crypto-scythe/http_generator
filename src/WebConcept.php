<?php

declare(strict_types=1);

namespace CryptoScythe\Http\Generator;

use CryptoScythe\Http\Generator\WebConcept\Value;

final class WebConcept
{
    public readonly string $id;

    public readonly string $registry;

    /** @var Value[] */
    public readonly array $values;

    public function __construct(array $data)
    {
        $this->id = (string) ($data['id'] ?? '');
        $this->registry = (string) ($data['registry'] ?? '');
        $this->values = array_map($this->valueFromArray(...), (array) ($data['values'] ?? []));
    }

    private function valueFromArray(array $data): Value
    {
        return new Value($data);
    }
}
