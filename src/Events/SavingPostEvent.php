<?php

namespace MennoTempelaar\NovaNewsTool\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use MennoTempelaar\NovaNewsTool\Models\PostModel;


class SavingPostEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public PostModel $post,
    ) { }
}
