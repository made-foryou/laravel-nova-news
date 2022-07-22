<?php

namespace Bondgenoot\NovaNewsTool\Events;

use Bondgenoot\NovaNewsTool\Models\PostModel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SavingPostEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public PostModel $post,
    ) {
    }
}
