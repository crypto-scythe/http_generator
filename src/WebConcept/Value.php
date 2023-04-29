<?php

declare(strict_types=1);

namespace CryptoScythe\Http\Generator\WebConcept;

use CryptoScythe\Http\Generator\WebConcept\Value\Detail;
use CryptoScythe\Http\Generator\WebConcept\Value\Details;

final class Value
{
    private string $value;

    private string $concept;

    private string $id;

    private string $description;

    /** @var Detail[]  */
    private array $details;

    public function __construct(array $data)
    {
        $this->value = (string) $data['value'];
        $this->concept = (string) $data['concept'];
        $this->id = (string) $data['id'];
        $this->description = (string) ($data['description'] ?? '');
        $this->details = array_map([$this, 'detailFromArray'], $data['details']);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function concept(): string
    {
        return $this->concept;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return Detail[]
     */
    public function details(): array
    {
        return $this->details;
    }

    private function detailFromArray(array $data): Detail
    {
        return new Detail($data);
    }
}
