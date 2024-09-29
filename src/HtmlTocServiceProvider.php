<?php

namespace l3aro\HtmlToc;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class HtmlTocServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('html-toc')
            ->hasConfigFile();
    }

    public function registeringPackage()
    {
        $this->app->bind(HtmlToc::class, function ($app) {
            return new HtmlToc($app->make(\Masterminds\HTML5::class));
        });
    }
}
