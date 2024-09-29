<?php

namespace L3aro\HtmlToc\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \L3aro\HtmlToc\HtmlToc
 */
class HtmlToc extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \L3aro\HtmlToc\HtmlToc::class;
    }
}
