<?php

namespace MennoTempelaar\NovaNewsTool\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use MennoTempelaar\NovaNewsTool\Events\SavingPost;
use MennoTempelaar\NovaNewsTool\Listeners\UpdatePostSlug;


class NewsEventsServiceProvider extends EventServiceProvider
{

    /**
     * @inheritdoc
     * @var array<string, array<string>>
     */
    protected $listen = [
        SavingPost::class => [
            UpdatePostSlug::class,
        ]
    ];
}
