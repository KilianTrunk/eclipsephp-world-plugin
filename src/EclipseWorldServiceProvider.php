<?php

namespace Eclipse\World;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class EclipseWorldServiceProvider extends PackageServiceProvider
{
    public static string $name = 'eclipse-world';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasTranslations();
    }
}
