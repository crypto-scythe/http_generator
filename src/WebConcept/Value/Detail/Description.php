<?php

declare(strict_types=1);

namespace CryptoScythe\Http\Generator\WebConcept\Value\Detail;

class Description
{
    private string $description;

    public function __construct(string $description)
    {
        $this->description = $description;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function wrapped(int $maxLength): array
    {
        $description = $this->description();

        if (strlen($description) <= $maxLength) {
            return [$description];
        }

        $lines = [];
        $currentLine = '';
        $words = explode(' ', $description);

        $maxIndex = count($words) - 1;

        foreach ($words as $index => $word) {
            if (strlen($currentLine . $word) >= $maxLength ) {
                $lines[] = trim($currentLine);
                $currentLine = $word . ' ';
            } else {
                $currentLine .= $word . ' ';
            }

            if ($index === $maxIndex) {
                $lines[] = trim($currentLine);
            }
        }

        return $lines;
    }
}
