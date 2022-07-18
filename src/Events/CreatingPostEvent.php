<?php

namespace MennoTempelaar\NovaNewsTool\Events;

use Illuminate\Foundation\Events\Dispatchable;
use MennoTempelaar\NovaNewsTool\Models\PostModel;


class CreatingPostEvent
{

    use Dispatchable;


    public function __construct(
        public PostModel $post
    ) { }

}
