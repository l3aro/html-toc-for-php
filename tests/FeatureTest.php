<?php

it('can setup the markup with random ids', function () {
    $html = <<<'HTML'
        <h1>Heading 1</h1>
        <h2>Heading 2</h2>
        <h3>Heading 3</h3>
        <h4>Heading 4</h4>
        <h5>Heading 5</h5>
        <h6>Heading 6</h6>
        <h6>Heading 6</h6>
        <h5>Heading 5</h5>
        <h6>Heading 6</h6>
        <h6>Heading 6</h6>
        <h4>Heading 4</h4>
        <h5>Heading 5</h5>
        <h6>Heading 6</h6>
        <h6>Heading 6</h6>
        <h5>Heading 5</h5>
        <h6>Heading 6</h6>
        <h6>Heading 6</h6>
        <h3>Heading 3</h3>
        <h4>Heading 4</h4>
        <h5>Heading 5</h5>
        <h6>Heading 6</h6>
        <h6>Heading 6</h6>
        <h5>Heading 5</h5>
        <h6>Heading 6</h6>
        <h6>Heading 6</h6>
        <h4>Heading 4</h4>
        <h5>Heading 5</h5>
        <h6>Heading 6</h6>
        <h6>Heading 6</h6>
        <h5>Heading 5</h5>
        <h6>Heading 6</h6>
        <h6>Heading 6</h6>
    HTML;


    $tocFactory = \l3aro\HtmlToc\Facades\HtmlToc::from($html);

    expect($tocFactory->getMarkup())->toBeString();
    expect($tocFactory->getTableOfContent())->toBeString();
});
