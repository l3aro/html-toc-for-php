<?php

namespace l3aro\HtmlToc;

use ArrayIterator;
use DOMDocument;
use DOMElement;
use DOMXPath;
use Illuminate\Support\Str;
use Masterminds\HTML5;

class HtmlToc
{
    public function __construct(
        protected HTML5 $parser,
        protected ?string $content = null,
    ) {}

    public function from($content): static
    {
        $this->content = $content;

        return $this;
    }

    public function prepareMarkup(int $topLevel = 1, int $depth = 6): string
    {
        $this->ensureContentHasBodyTag();

        $domDocument = $this->loadHtml($topLevel, $depth);

        return $this->parser->saveHTML($domDocument);
    }

    protected function ensureContentHasBodyTag(): static
    {
        $this->content = sprintf(
            "<body id='%s'>%s</body>",
            uniqid('toc_generator_'),
            $this->content,
        );

        return $this;
    }

    protected function loadHtml(int $topLevel, int $depth): DOMDocument
    {
        $domDocument = $this->parser->loadHTML($this->content);
        $domDocument->preserveWhiteSpace = true;

        /** @var DOMElement $node */
        foreach ($this->traverseHeaderTags($domDocument, $topLevel, $depth) as $node) {
            if ($node->getAttribute('id')) {
                continue;
            }

            $node->setAttribute('id', Str::ulid()->toString());
        }

        return $domDocument;
    }

    protected function traverseHeaderTags(DOMDocument $domDocument, int $topLevel, int $depth)
    {
        $xPath = new DOMXPath($domDocument);
        $xPathQuery = sprintf(
            "//*[%s]",
            implode(
                ' or ',
                array_map(
                    fn($localName) => sprintf('local-name() = "%s', $localName),
                    $this->determineHeaderTags($topLevel, $depth),
                ),
            ),
        );

        $nodes = [];
        foreach ($xPath->query($xPathQuery) as $node) {
            dd($node);
            $nodes = $node;
        }

        return new ArrayIterator($nodes);
    }

    protected function determineHeaderTags(int $topLevel, int $depth)
    {
        $desired = range($topLevel, $topLevel + ($depth - 1));
        $allowed = [1, 2, 3, 4, 5, 6];

        return array_map(
            fn($value) => 'h' . $value,
            array_intersect($desired, $allowed),
        );
    }
}
