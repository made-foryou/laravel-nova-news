<?php

namespace Bondgenoot\NovaNewsTool\Repositories;

use Bondgenoot\NovaNewsTool\Models\PostModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Post repository
 * ------------------------------------------------------------------------
 *
 * Object for retrieving posts data from the database.
 */
class PostRepository
{
    /**
     * The selected author model or null.
     *
     * (i) When this model has been selected and inserted into this object; the
     *     next query method will use this value within the query. Afterwards
     *     the value will be reset to null.
     *
     * @var Model|null
     */
    protected Model|null $author = null;

    /**
     * Returns a collection of posts which can be showed within an overview.
     *
     * @return Collection<PostModel>
     */
    public function forOverview(): Collection
    {
        $query = PostModel::published()
            ->visible()
            ->orderByDesc('published_at');

        if ($this->author !== null) {
            $query = $query->fromAuthor($this->author);
        }

        $this->author = null;

        return $query->get();
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
        $query = PostModel::published()
            ->visible()
            ->orderByDesc('published_at')
            ->limit($limit);

        if ($this->author !== null) {
            $query = $query->fromAuthor($this->author);
        }

        $this->author = null;

        return $query->get();
    }

    /**
     * Inserts an author model into this object which makes the next query
     * method use this value within its query results.
     *
     * @param  Model  $model  The author model you want to add to the select
     *                        query.
     * @return $this
     */
    public function fromAuthor(Model $model): self
    {
        $this->author = $model;

        return $this;
    }
}
