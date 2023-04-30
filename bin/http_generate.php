#!/usr/bin/env php
<?php

declare(strict_types=1);

/** @var string|null $_composer_autoload_path */
/** @psalm-suppress UnresolvableInclude */
require $_composer_autoload_path ?? __DIR__ . '/../vendor/autoload.php';

use CryptoScythe\Http\Generator\Definition;
use CryptoScythe\Http\Generator\Generator;
use CryptoScythe\Http\Generator\Renderer\AuthenticationSchemesRenderer;
use CryptoScythe\Http\Generator\Renderer\CacheDirectivesRenderer;
use CryptoScythe\Http\Generator\Renderer\ContentCodingsRenderer;
use CryptoScythe\Http\Generator\Renderer\ForwardedParametersRenderer;
use CryptoScythe\Http\Generator\Renderer\HeaderFieldsRenderer;
use CryptoScythe\Http\Generator\Renderer\LinkRelationsRenderer;
use CryptoScythe\Http\Generator\Renderer\MediaTypesRenderer;
use CryptoScythe\Http\Generator\Renderer\PreferencesRenderer;
use CryptoScythe\Http\Generator\Renderer\RangeUnitsRenderer;
use CryptoScythe\Http\Generator\Renderer\RequestMethodsRenderer;
use CryptoScythe\Http\Generator\Renderer\StatusCodeRenderer;
use CryptoScythe\Http\Generator\Renderer\TransferCodingsRenderer;

set_error_handler(
    function (int $severity, string $message, string $file, int $line): void {
        throw new ErrorException($message, $severity, $severity, $file, $line);
    }
);

try {
    if (count($argv) < 2) {
        throw new RuntimeException('Namespace and output directory missing', 1);
    } elseif (count($argv) < 3) {
        throw new RuntimeException('Output directory missing', 1);
    }

    [, $namespace, $outputDirectory] = $argv;

    if (is_dir($outputDirectory) === false || is_writable($outputDirectory) === false) {
        throw new RuntimeException(
            sprintf('Output directory "%s" does not exist or is not writeable', $outputDirectory),
            2,
        );
    }

    $outputPath = rtrim(realpath($outputDirectory), '/');

    $definitions = [
        new Definition(
            'http-authentication-scheme.json',
            'AuthenticationSchemes',
            new AuthenticationSchemesRenderer(),
            $namespace,
        ),
        new Definition(
            'http-cache-directive.json',
            'CacheDirectives',
            new CacheDirectivesRenderer(),
            $namespace,
        ),
        new Definition(
            'http-content-coding.json',
            'ContentCodings',
            new ContentCodingsRenderer(),
            $namespace,
        ),
        new Definition(
            'http-forwarded-parameter.json',
            'ForwardedParameters',
            new ForwardedParametersRenderer(),
            $namespace,
        ),
        new Definition(
            'http-header.json',
            'HeaderFields',
            new HeaderFieldsRenderer(),
            $namespace,
        ),
        new Definition(
            'link-relation.json',
            'LinkRelations',
            new LinkRelationsRenderer(),
            $namespace,
        ),
        new Definition(
            'media-type.json',
            'MediaTypes',
            new MediaTypesRenderer(),
            $namespace,
        ),
        new Definition(
            'http-preference.json',
            'Preferences',
            new PreferencesRenderer(),
            $namespace,
        ),
        new Definition(
            'http-range-unit.json',
            'RangeUnits',
            new RangeUnitsRenderer(),
            $namespace,
        ),
        new Definition(
            'http-method.json',
            'RequestMethods',
            new RequestMethodsRenderer(),
            $namespace,
        ),
        new Definition(
            'http-status-code.json',
            'StatusCodes',
            new StatusCodeRenderer(),
            $namespace,
        ),
        new Definition(
            'http-transfer-coding.json',
            'TransferCodings',
            new TransferCodingsRenderer(),
            $namespace,
        ),
    ];

    echo 'Generating classes' . PHP_EOL;

    foreach ($definitions as $definition) {
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
                implode(
                    PHP_EOL,
                    array_map(
                        fn (mixed $value) => (string) $value,
                        array_filter($output)
                    ),
                ),
                $resultCode,
            );
        }

        echo ' - syntax check ok' . PHP_EOL;
    }

    echo 'done' . PHP_EOL;
} catch (Throwable $error) {
    echo PHP_EOL . 'Error: ' . $error->getMessage() . PHP_EOL;
    exit($error->getCode());
}
