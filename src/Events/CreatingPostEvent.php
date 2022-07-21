<?php

namespace Bondgenoot\NovaNewsTool\Events;

use Bondgenoot\NovaNewsTool\Models\PostModel;
use Illuminate\Foundation\Events\Dispatchable;

class CreatingPostEvent
{
    use Dispatchable;

    public function __construct(
        public PostModel $post
    ) {
    }
}
