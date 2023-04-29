<?php

declare(strict_types=1);

namespace CryptoScythe\Http\Generator\WebConcept\Value;

use CryptoScythe\Http\Generator\WebConcept\Value\Detail\Description;

final class Detail
{
    private Description $description;

    private string $documentation;

    private string $specification;

    private string $specName;

    public function __construct(array $data)
    {
        $this->description = new Description($data['description']);
        $this->documentation = (string) $data['documentation'];
        $this->specification = (string) $data['specification'];
        $this->specName = (string) $data['spec-name'];
    }

    public function description(): Description
    {
        return $this->description;
    }

    public function documentation(): string
    {
        return $this->documentation;
    }

    public function specification(): string
    {
        return $this->specification;
    }

    public function specName(): string
    {
        return $this->specName;
    }
}
