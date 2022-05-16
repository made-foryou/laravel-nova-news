<?php

namespace MennoTempelaar\NovaNewsTool\Listeners;

use Illuminate\Support\Str;
use MennoTempelaar\NovaNewsTool\Events\SavingPost;
use MennoTempelaar\NovaNewsTool\Models\Post;

use function ray;


class UpdatePostSlug
{

    const COLUMN_SLUG  = 'slug';

    const COLUMN_TITLE = 'title';

    public function handle (SavingPost $event): void
    {

        $slug = null;

        if (!$this->changedSlugManually($event->post) && !$this->changedTitle($event->post)) {

            return;

        }

        if ($this->changedSlugManually($event->post)) {

            $slug = Str::slug($event->post->slug);

        } else {

            $slug = $this->generateSlugFromTitle($event->post->title);

        }

        $count = $this->countNumberOfTimesUsed($slug, $event->post->id);

        $event->post->slug = $count ? "{$slug}-{$count}" : $slug;

    }

    protected function changedSlugManually (Post $post): bool
    {

        return $post->isDirty(self::COLUMN_SLUG);

    }

    protected function changedTitle (Post $post): bool
    {

        return $post->isDirty(self::COLUMN_TITLE);

    }

    protected function generateSlugFromTitle (string $title): string
    {

        return Str::slug($title);

    }

    protected function countNumberOfTimesUsed (string $slug, ?int $id): int
    {

        if ($id) {

            return Post::where('id', '!=', $id)
                ->whereRaw(self::COLUMN_SLUG . " RLIKE '^{$slug}(-[0-9]+)?$'")
                ->count();

        }

        return Post::whereRaw(
            self::COLUMN_SLUG . " RLIKE '^{$slug}(-[0-9]+)?$'",
        )->count();

    }

}

