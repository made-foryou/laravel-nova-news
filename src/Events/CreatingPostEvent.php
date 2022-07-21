<?php

namespace Bondgenoot\NovaNewsTool\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Bondgenoot\NovaNewsTool\Models\PostModel;

class CreatingPostEvent
{
    use Dispatchable;

    public function __construct(
        public PostModel $post
    ) {
    }
}
