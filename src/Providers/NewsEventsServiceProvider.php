<?php

namespace Bondgenoot\NovaNewsTool\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Bondgenoot\NovaNewsTool\Events\CreatingPostEvent;
use Bondgenoot\NovaNewsTool\Events\SavingPostEvent;
use Bondgenoot\NovaNewsTool\Listeners\SaveCreatedByListener;
use Bondgenoot\NovaNewsTool\Listeners\UpdatePostSlugListener;


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
        ],
    ];

}
