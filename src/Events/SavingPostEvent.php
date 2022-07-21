<?php

namespace MennoTempelaar\NovaNewsTool\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use MennoTempelaar\NovaNewsTool\Models\PostModel;

class SavingPostEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public PostModel $post,
    ) {
    }
}
