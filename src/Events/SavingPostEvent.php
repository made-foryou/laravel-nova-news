<?php

namespace Bondgenoot\NovaNewsTool\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Bondgenoot\NovaNewsTool\Models\PostModel;

class SavingPostEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public PostModel $post,
    ) {
    }
}
