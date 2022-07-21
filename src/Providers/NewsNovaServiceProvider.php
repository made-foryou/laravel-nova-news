<?php

namespace MennoTempelaar\NovaNewsTool\Providers;

use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use MennoTempelaar\NovaNewsTool\Nova\PostResource;

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
