<?php

namespace Bondgenoot\NovaNewsTool\Repositories;

use Bondgenoot\NovaNewsTool\Models\PostModel;
use Illuminate\Database\Eloquent\Collection;

/**
 * Post repository
 * ------------------------------------------------------------------------
 *
 * Object for retrieving posts data from the database.
 */
class PostRepository
{
    /**
     * Returns a collection of posts which can be showed within an overview.
     *
     * @return Collection<PostModel>
     */
    public function forOverview(): Collection
    {
        return PostModel::published()
            ->visible()
            ->orderByDesc('published_at')
            ->get();
    }

    /**
     * Returns a collection of posts with a limit according to the parameter
     * of Posts which can be showed within a preview widget.
     *
     * @param  int  $limit  Determines how many items you will receive.
     * @return Collection<PostModel>
     */
    public function forPreview(int $limit = 3): Collection
    {
        return PostModel::published()
            ->visible()
            ->orderByDesc('published_at')
            ->limit($limit)
            ->get();
    }
}
