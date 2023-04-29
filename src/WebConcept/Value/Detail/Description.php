<?php

declare(strict_types=1);

namespace CryptoScythe\Http\Generator\WebConcept\Value\Detail;

class Description
{
    public function __construct(private readonly string $description)
    {
    }

    /**
     * @return string[]
     */
    public function wrapped(int $maxLength): array
    {
        $description = $this->description;

        if (strlen($description) <= $maxLength) {
            return [$description];
        }

        $lines = [];
        $currentLine = '';
        $words = explode(' ', $description);

        $maxIndex = count($words) - 1;

        foreach ($words as $index => $word) {
            if (strlen($currentLine . $word) >= $maxLength) {
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
