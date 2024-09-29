<?php

namespace l3aro\HtmlToc\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use l3aro\HtmlToc\HtmlTocServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            HtmlTocServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        /*
        $migration = include __DIR__.'/../database/migrations/create_html-toc_table.php.stub';
        $migration->up();
        */
    }
}
