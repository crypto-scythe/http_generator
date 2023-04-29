<?php

declare(strict_types=1);

namespace CryptoScythe\Http\Generator\WebConcept;

use CryptoScythe\Http\Generator\WebConcept\Value\Detail;

final class Value
{
    public readonly string $value;

    public readonly string $description;

    /** @var Detail[]  */
    public readonly array $details;

    public function __construct(array $data)
    {
        $this->value = (string) ($data['value'] ?? '');
        $this->description = (string) ($data['description'] ?? '');
        $this->details = array_map($this->detailFromArray(...), ((array) ($data['details'] ?? [])));
    }

    private function detailFromArray(array $data): Detail
    {
        return new Detail($data);
    }
}
