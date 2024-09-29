<?php

namespace l3aro\HtmlToc\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \l3aro\HtmlToc\HtmlToc from(string $content)
 * @see \l3aro\HtmlToc\HtmlToc
 */
class HtmlToc extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \l3aro\HtmlToc\HtmlToc::class;
    }
}
