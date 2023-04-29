<?php

namespace CryptoScythe\Http\Generator;

final class Definition
{
    public readonly string $namespace;

    public function __construct(
        public readonly string $className,
        public readonly RendererInterface $renderer,
        private readonly string $conceptFile,
    ) {
        $this->namespace = 'CryptoScythe\Http';
    }

    public function conceptUrl(): string
    {
        return 'https://webconcepts.info/concepts/' . $this->conceptFile;
    }

    public function fileName(): string
    {
        return $this->className . '.php';
    }
}