<?php

declare(strict_types=1);

namespace CryptoScythe\Http\Generator;

use CryptoScythe\Http\Generator\WebConcept\Value\Detail;

final class Generator
{
    public function generate(
        string $outputPath,
        Definition $definition
    ): void {
        $webConcept = new WebConcept(
            json_decode(
                file_get_contents($definition->conceptUrl()),
                true,
                JSON_THROW_ON_ERROR
            ),
        );

        $constants = [];
        $registry = $webConcept->registry();
        $conceptLink = $webConcept->id();

        foreach ($webConcept->values() as $value) {
            $constContent = $definition->renderer->renderConstWithContent($value);

            $block = join(
                "\n     * \n     * ",
                array_map($this->documentationBlock(...), $value->details())
            );

            $constants[] = <<<EOCONST
                /**
                 * {$value->value()}
                 *
                 * {$block}
                 */
                {$constContent}
            EOCONST;
        }

        $joinedConstants = join("\n\n", $constants);

        $class = <<<EOPHP
        <?php
        
        declare(strict_types=1);
        
        namespace {$definition->namespace};
        
        /**
         * Class {$definition->className}
         * 
         * @see {$conceptLink}
         * @see {$registry}
         */
        final class {$definition->className} {
        {$joinedConstants}
        }
        
        EOPHP;

        file_put_contents(
            sprintf(
                '%s/%s',
                rtrim($outputPath, '/'),
                $definition->fileName(),
            ),
            $this->replaceHttpWithHttps($class)
        );
    }

    private function documentationBlock(Detail $detail): string {

        if (!empty($detail->description())) {
            $description = join("\n     * ", $detail->description()->wrapped(110));

            return <<<EODOC
            {$description}
                 *
                 * @see {$detail->specification()}
                 * @see {$detail->documentation()}
            EODOC;
        }

        return <<<EODOC
             * @see {$detail->specification()}
             * @see {$detail->documentation()}
        EODOC;
    }

    private function replaceHttpWithHttps(string $url) {
        return str_replace('http://', 'https://', $url);
    }
}
