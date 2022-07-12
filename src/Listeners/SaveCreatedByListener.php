<?php

namespace MennoTempelaar\NovaNewsTool\Listeners;

use Illuminate\Support\Facades\Auth;
use MennoTempelaar\NovaNewsTool\Events\CreatingPostEvent;


class SaveCreatedByListener
{

    public function handle ( CreatingPostEvent $event ): void
    {

        $event->post->createdBy()->associate(Auth::user());

    }

}
