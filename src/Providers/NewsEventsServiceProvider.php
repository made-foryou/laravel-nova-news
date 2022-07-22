<?php

namespace Bondgenoot\NovaNewsTool\Providers;

use Bondgenoot\NovaNewsTool\Events\CreatingPostEvent;
use Bondgenoot\NovaNewsTool\Events\SavingPostEvent;
use Bondgenoot\NovaNewsTool\Listeners\SaveCreatedByListener;
use Bondgenoot\NovaNewsTool\Listeners\UpdatePostSlugListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class NewsEventsServiceProvider extends EventServiceProvider
{
    /**
     * {@inheritdoc}
     *
     * @var array<string, array<string>>
     */
    protected $listen = [
        SavingPostEvent::class => [
            UpdatePostSlugListener::class,
        ],

        CreatingPostEvent::class => [
            SaveCreatedByListener::class,
        ],
    ];
}
