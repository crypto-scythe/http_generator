<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use CryptoScythe\Http\Generator\Definition;
use CryptoScythe\Http\Generator\Generator;
use CryptoScythe\Http\Generator\HeaderFieldsRenderer;
use CryptoScythe\Http\Generator\MediaTypesRenderer;
use CryptoScythe\Http\Generator\StatusCodeRenderer;

set_error_handler(
    function (int $severity, string $message, string $file, int $line): void
    {
        throw new ErrorException($message, $severity, $severity, $file, $line);
    }
);

try {
    if (count($argv) < 2) {
        throw new RuntimeException('Output directory missing', 1);
    }

    [, $outputDirectory] = $argv;

    if (is_dir($outputDirectory) === false || is_writable($outputDirectory) === false) {
        throw new RuntimeException(
            sprintf('Output directory "%s" does not exist or is not writeable', $outputDirectory),
            2,
        );
    }

    $outputPath = rtrim(realpath($outputDirectory), '/');

    $definitions = [
        new Definition(
            'HeaderFields',
            new HeaderFieldsRenderer(),
            'http-header.json',
        ),
        new Definition(
            'MediaTypes',
            new MediaTypesRenderer(),
            'media-type.json',
        ),
        new Definition(
            'StatusCodes',
            new StatusCodeRenderer(),
            'http-status-code.json',
        ),
    ];

    echo 'Generating classes' . PHP_EOL;

    foreach($definitions as $definition) {
        echo sprintf(
            ' - %s -> %s/%s',
            $definition->className,
            $outputPath,
            $definition->fileName(),
        );

        (new Generator())->generate(
            $outputPath,
            $definition,
        );

        $resultCode = 0;
        $output = [];
        exec(sprintf('php -l %s/%s 2>&1', $outputPath, $definition->fileName()), $output, $resultCode);

        if ($resultCode > 0) {
            throw new RuntimeException(
                implode(PHP_EOL, array_filter($output)),
                $resultCode,
            );
        }

        echo ' - syntax check ok' . PHP_EOL;
    }

    echo 'done' . PHP_EOL;
} catch (Throwable $error) {
    echo 'Error: ' . $error->getMessage() . PHP_EOL;
    exit($error->getCode());
}
