<?php

declare(strict_types=1);

namespace CryptoScythe\Http\Generator;

use CryptoScythe\Http\Generator\WebConcept\Value;

final class WebConcept
{
    private string $concept;

    private string $id;

    private string $nameSingular;

    private string $namePlural;

    private string $registry;

    /** @var Value[] */
    private array $values;

    public function __construct(array $data)
    {
        $this->concept = (string) $data['concept'];
        $this->id = (string) $data['id'];
        $this->nameSingular = (string) $data['name-singular'];
        $this->namePlural = (string) $data['name-plural'];
        $this->registry = (string) $data['registry'];
        $this->values = array_map([$this, 'valueFromArray'], $data['values']);
    }

    public function concept(): string
    {
        return $this->concept;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function nameSingular(): string
    {
        return $this->nameSingular;
    }

    public function namePlural(): string
    {
        return $this->namePlural;
    }

    public function registry(): string
    {
        return $this->registry;
    }

    /**
     * @return Value[]
     */
    public function values(): array
    {
        return $this->values;
    }

    private function valueFromArray(array $data): Value
    {
        return new Value($data);
    }
}
