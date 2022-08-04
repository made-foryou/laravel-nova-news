<?php

namespace Bondgenoot\NovaNewsTool\Listeners;

use Bondgenoot\NovaNewsTool\Events\SavingPostEvent;
use Bondgenoot\NovaNewsTool\Models\PostModel;
use Illuminate\Support\Str;
use function preg_match;

class UpdatePostSlugListener
{
    const COLUMN_SLUG = 'slug';

    const COLUMN_TITLE = 'title';

    public function handle(SavingPostEvent $event): void
    {
        $slug = null;

        if ($event->post->title === null) {
            return;
        }

        if (! $this->changedSlugManually($event->post)
            && ! $this->changedTitle($event->post)
        ) {
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

    protected function changedSlugManually(PostModel $post): bool
    {
        return $post->isDirty(self::COLUMN_SLUG);
    }

    protected function changedTitle(PostModel $post): bool
    {
        return $post->isDirty(self::COLUMN_TITLE);
    }

    protected function generateSlugFromTitle(string $title): string
    {
        return Str::slug($title);
    }

    protected function countNumberOfTimesUsed(string $slug, ?int $id): int
    {
        if ($id) {
            if ($this->getDatabaseDriver() === 'mysql') {
                return PostModel::where('id', '!=', $id)
                    ->whereRaw(self::COLUMN_SLUG." RLIKE '^{$slug}(-[0-9]+)?$'")
                    ->count();
            } else {
                $posts = PostModel::where('id', '!=', $id)->get();

                return $posts->filter(
                    fn ($post) => preg_match(
                        "^{$slug}(-\d+)?$^",
                        $post->slug,
                    ) === 1,
                )->count();
            }
        }

        if ($this->getDatabaseDriver() === 'mysql') {
            return PostModel::whereRaw(
                self::COLUMN_SLUG." RLIKE '^{$slug}(-[0-9]+)?$'",
            )->count();
        } else {
            return PostModel::all()
                ->filter(
                    fn ($post) => preg_match(
                        "^{$slug}(-\d+)?$^",
                        $post->slug,
                    ) === 1,
                )->count();
        }
    }

    protected function getDatabaseDriver(): string
    {
        $default = config('database.default');

        return config("database.connections.{$default}.driver");
    }
}
