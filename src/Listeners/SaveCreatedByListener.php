<?php

namespace Bondgenoot\NovaNewsTool\Listeners;

use Bondgenoot\NovaNewsTool\Events\CreatingPostEvent;
use Illuminate\Support\Facades\Auth;

class SaveCreatedByListener
{
    public function handle(CreatingPostEvent $event): void
    {
        $event->post->createdBy()->associate(Auth::user());
    }
}
