<?php

namespace l3aro\HtmlToc;

interface HtmlTocContract
{
    public function getTableOfContent(): string;
    public function getMarkup(): string;
}
