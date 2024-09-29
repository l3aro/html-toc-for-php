# Generate Table of Contents from HTML for PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/l3aro/html-toc.svg?style=flat-square)](https://packagist.org/packages/l3aro/html-toc)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/l3aro/html-toc/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/l3aro/html-toc/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/l3aro/html-toc/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/l3aro/html-toc/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/l3aro/html-toc.svg?style=flat-square)](https://packagist.org/packages/l3aro/html-toc)

This is a PHP package that generates Table of Contents from HTML.

## Installation

You can install the package via composer:

```bash
composer require l3aro/html-toc
```

## Usage

### With Dependency Injection

```php
use l3aro\HtmlToc\HtmlToc;

public function show(HtmlToc $toc) {
    $content = <<<HTML
        <h2>This is heading H2</h2>
        <h3>This is heading H3</h3>
        <h4>This is heading H4</h4>
        <h2>This is heading H2</h2>
    HTML;

    $markup = $toc->from($content);
    $markupContent = $markup->getMarkup();
    $tableOfContent = $markup->getTableOfContent();

    $htmlOut  = "<div class='content'>" . $markupContent . "</div>";
    $htmlOut .= "<div class='toc'>" . $tableOfContent . "</div>";

    return $htmlOut;
 }
```

### With Facade

```php
use l3aro\HtmlToc\Facades\HtmlToc;

public function show() {
    $content = <<<HTML
        <h2>This is heading H2</h2>
        <h3>This is heading H3</h3>
        <h4>This is heading H4</h4>
        <h2>This is heading H2</h2>
    HTML;

    $markup = HtmlToc::from($content);
    $markupContent = $markup->getMarkup();
    $tableOfContent = $markup->getTableOfContent();

    $htmlOut  = "<div class='content'>" . $markupContent . "</div>";
    $htmlOut .= "<div class='toc'>" . $tableOfContent . "</div>";

    return $htmlOut;
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [l3aro](https://github.com/l3aro)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
