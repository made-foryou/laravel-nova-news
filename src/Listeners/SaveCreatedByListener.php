<?php

namespace Bondgenoot\NovaNewsTool\Listeners;

use Illuminate\Support\Facades\Auth;
use Bondgenoot\NovaNewsTool\Events\CreatingPostEvent;


class SaveCreatedByListener
{

    public function handle(CreatingPostEvent $event): void
    {

        $event->post->createdBy()->associate(Auth::user());

    }

}
