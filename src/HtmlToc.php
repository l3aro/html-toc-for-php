<?php

namespace l3aro\HtmlToc;

use DOMDocument;
use DOMElement;
use DOMXPath;
use Knp\Menu\ItemInterface;
use Knp\Menu\MenuFactory;
use Knp\Menu\Renderer\ListRenderer;
use l3aro\HtmlToc\Exceptions\ContentNotSetException;
use Masterminds\HTML5;

class HtmlToc implements HtmlTocContract
{
    protected string $markup;

    protected ?string $content = null;

    protected int $topLevel = 1;

    protected int $maxDepth = 6;

    public function __construct(
        protected HTML5 $parser,
        protected MenuFactory $menuFactory,
        protected ListRenderer $listRenderer,
    ) {}

    public function from($content, int $topLevel = 1, int $maxDepth = 6): static
    {
        $this->content = $content;
        $this->topLevel = $topLevel;
        $this->maxDepth = $maxDepth;

        $this->prepareMarkup();

        return $this;
    }

    protected function prepareMarkup(): static
    {
        if (! isset($this->content)) {
            throw ContentNotSetException::make();
        }

        $this->ensureContentHasBodyTag();

        $domDocument = $this->loadHtml();

        $this->markup = $this->parser->saveHTML(
            $domDocument->getElementsByTagName('body')->item(0)->childNodes,
        );


        return $this;
    }

    public function getMarkup(): string
    {
        if (! isset($this->markup)) {
            $this->prepareMarkup();
        }

        return $this->markup;
    }

    public function getTableOfContent(): string
    {
        $menu = $this->menuFactory->createItem('tableOfContent');

        if (! isset($this->markup)) {
            $this->prepareMarkup();
        }

        $tagsToMatch = $this->determineHeaderTags();

        $lastElement = $menu;

        $domDocument = $this->parser->loadHTML($this->markup);

        foreach ($this->traverseHeaderTags($domDocument) as $node) {
            if (! $node->hasAttribute('id')) {
                continue;
            }

            $tagName = $node->tagName;
            /** @var int $level */
            $level = array_search(strtolower($tagName), $tagsToMatch) + 1;
            $parent = $this->getParentToAddChildTo($lastElement, $level, $menu);

            $lastElement = $parent->addChild(
                $node->getAttribute('id'),
                [
                    'label' => $node->getAttribute('title') ?: $node->textContent,
                    'uri' => '#' . $node->getAttribute('id'),
                ],
            );
        }

        return $this->listRenderer->render($menu);
    }

    protected function getParentToAddChildTo(ItemInterface $lastElement, int $level, ItemInterface $menu): ItemInterface
    {
        if ($level === 1) {
            return $menu;
        }

        if ($level === $lastElement->getLevel()) {
            return $lastElement->getParent();
        }

        if ($level > $lastElement->getLevel()) {
            $parent = $lastElement;

            for ($counter = $lastElement->getLevel(); $counter < $level - 1; $counter++) {
                $parent = $parent->addChild('');
            }

            return $parent;
        }

        $parent = $lastElement->getParent();

        while ($parent->getLevel() > $level - 1) {
            $parent = $parent->getParent();
        }

        return $parent;
    }

    protected function ensureContentHasBodyTag(): static
    {
        if (strpos($this->content, "<body") !== false && strpos($this->content, "</body>") !== false) {
            return $this;
        }

        $this->content = sprintf(
            "<body>%s</body>",
            $this->content,
        );

        return $this;
    }

    protected function loadHtml(): DOMDocument
    {
        $domDocument = $this->parser->loadHTML($this->content);
        $domDocument->preserveWhiteSpace = true;

        foreach ($this->traverseHeaderTags($domDocument) as $node) {
            if ($node->getAttribute('id')) {
                continue;
            }

            $node->setAttribute('id', uniqid());
        }

        return $domDocument;
    }

    /**
     * @return DOMElement[]
     */
    protected function traverseHeaderTags(DOMDocument $domDocument): array
    {
        $xPath = new DOMXPath($domDocument);
        $xPathQuery = sprintf(
            "//*[%s]",
            implode(
                ' or ',
                array_map(
                    fn($localName) => sprintf('local-name() = "%s"', $localName),
                    $this->determineHeaderTags(),
                ),
            ),
        );

        $nodes = [];
        foreach ($xPath->query($xPathQuery) as $node) {
            $nodes[] = $node;
        }

        return $nodes;
    }

    protected function determineHeaderTags()
    {
        $desired = range($this->topLevel, $this->topLevel + ($this->maxDepth - 1));
        $allowed = [1, 2, 3, 4, 5, 6];

        return array_map(
            fn($value) => 'h' . $value,
            array_intersect($desired, $allowed),
        );
    }
}
