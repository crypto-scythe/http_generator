<?php

namespace CryptoScythe\Http\Generator;

final class Definition
{
    public function __construct(
        private readonly string $conceptFile,
        public readonly string $className,
        public readonly RendererInterface $renderer,
        public readonly string $namespace,
    ) {
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
