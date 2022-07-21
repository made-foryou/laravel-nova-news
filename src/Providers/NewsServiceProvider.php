<?php

namespace Bondgenoot\NovaNewsTool\Providers;

use Illuminate\Support\ServiceProvider;


class NewsServiceProvider extends ServiceProvider
{

    public function register()
    {

        // Merging the package configuration
        $this->mergeConfigFrom(
            __DIR__.'/../../config/config.php',
            'nova-news-tool'
        );

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        $this->loadTranslationsFrom(
            __DIR__.'/../../lang',
            'nova-news-tool'
        );

    }

    public function boot()
    {

        if ($this->app->runningInConsole()) {

            // Exports the configuration file from this package to the project
            $this->publishes(
                [
                    __DIR__.'/../../config/config.php' => config_path(
                        'nova-news-tool.php'
                    ),
                ],
                'config'
            );

            // Exports the translation files from this package to the project
            $this->publishes(
                [
                    __DIR__.'/../../lang/en/' => config_path(
                        ''
                    ),
                ],
                'translations'
            );

        }

    }

}
