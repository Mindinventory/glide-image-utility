<?php

namespace Mi\MiImageUtility;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Mi\MiImageUtility\Commands\MiImageUtilityCommand;

class MiImageUtilityServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('glide-image-utility')
            ->hasConfigFile();
    }
}
