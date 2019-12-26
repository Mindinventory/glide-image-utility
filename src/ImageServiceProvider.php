<?php

namespace Mi\MiImageUtility;

use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->make('Mi\MiImageUtility\MiImage');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/mi-utility.php' => config_path('mi-utility.php')
        ], 'config');
    }
}
