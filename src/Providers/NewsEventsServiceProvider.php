<?php

namespace MennoTempelaar\NovaNewsTool\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use MennoTempelaar\NovaNewsTool\Events\CreatingPostEvent;
use MennoTempelaar\NovaNewsTool\Events\SavingPostEvent;
use MennoTempelaar\NovaNewsTool\Listeners\SaveCreatedByListener;
use MennoTempelaar\NovaNewsTool\Listeners\UpdatePostSlugListener;


class NewsEventsServiceProvider extends EventServiceProvider
{

    /**
     * @inheritdoc
     * @var array<string, array<string>>
     */
    protected $listen = [
        SavingPostEvent::class => [
            UpdatePostSlugListener::class,
        ],

        CreatingPostEvent::class => [
            SaveCreatedByListener::class,
        ]
    ];
}
