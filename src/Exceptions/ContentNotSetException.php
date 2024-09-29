<?php

namespace l3aro\HtmlToc\Exceptions;

use Exception;

final class ContentNotSetException extends Exception
{
    public static function make(): static
    {
        return new static('Content not set');
    }
}
