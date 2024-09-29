<?php

it('can setup the markup with random ids', function () {
    $html = <<<'HTML'
        <h1>Heading 1</h1>
        <h2>Heading 2</h2>
        <h2>Heading 2</h2>
        <h2>Heading 2</h2>
        <h2>Heading 2</h2>
    HTML;


    $tocFactory = \l3aro\HtmlToc\Facades\HtmlToc::from($html);

    expect($tocFactory->getMarkup())->toBeString();
    expect($tocFactory->getTableOfContent())->toBeString();
});
