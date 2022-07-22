<?php

namespace Bondgenoot\NovaNewsTool\Providers;

use Bondgenoot\NovaNewsTool\Nova\PostResource;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NewsNovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Boots everything this package needs to boot into Nova.
     *
     * @return void
     */
    public function boot(): void
    {
        Nova::resources([
            PostResource::class,
        ]);
    }
}
