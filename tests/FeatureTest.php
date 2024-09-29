<?php

it('can test', function () {
    expect(true)->toBeTrue();
});

it('can setup the markup with random ids', function () {
    $html = <<<'HTML'
        <h1>Heading 1</h1>
        <h2>Heading 2</h2>
        <h3>Heading 3</h3>
        <h4>Heading 4</h4>
        <h5>Heading 5</h5>
        <h6>Heading 6</h6>
        <p>Paragraph</p>
        <ul>
            <li>Item 1</li>
            <li>Item 2</li>
            <li>Item 3</li>
        </ul>
        <ol>
            <li>Item 1</li>
            <li>Item 2</li>
            <li>Item 3</li>
        </ol>
        <table>
            <thead>
                <tr>
                    <th>Column 1</th>
                    <th>Column 2</th>
                    <th>Column 3</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Row 1, Cell 1</td>
                    <td>Row 1, Cell 2</td>
                    <td>Row 1, Cell 3</td>
                </tr>
                <tr>
                    <td>Row 2, Cell 1</td>
                    <td>Row 2, Cell 2</td>
                    <td>Row 2, Cell 3</td>
                </tr>
            </tbody>
        </table>
        <blockquote>
            <p>Quote</p>
        </blockquote>
        <pre>
            <code>
                Code
            </code>
        </pre>
        <details>
            <summary>Details</summary>
            <p>Details</p>
        </details>
        <hr>
        <br>
        <address>
            Address
        </address>
    HTML;


    dd(\L3aro\HtmlToc\Facades\HtmlToc::from($html)->prepareMarkup());
});
