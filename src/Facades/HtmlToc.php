<?php

namespace L3aro\HtmlToc\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \L3aro\HtmlToc\HtmlToc from(string $content)
 * @see \L3aro\HtmlToc\HtmlToc
 */
class HtmlToc extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \L3aro\HtmlToc\HtmlToc::class;
    }
}
