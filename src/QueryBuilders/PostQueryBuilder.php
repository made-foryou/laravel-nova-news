<?php

namespace Bondgenoot\NovaNewsTool\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PostQueryBuilder extends Builder
{
    /**
     * Adds the query statements for selecting the posts which are published.
     *
     * @return $this
     */
    public function published(): self
    {
        return $this->whereDate('published_at', '<=', Carbon::now())
            ->where(function (PostQueryBuilder $query) {
                $query->whereNull('published_till')
                   ->orWhereDate('published_till', '>=', Carbon::now());
            });
    }

    /**
     * Adds the query statement for selecting the visible posts. These are
     * posts which are not hidden.
     *
     * @return $this
     */
    public function visible(): self
    {
        return $this->where('hidden', '=', '0');
    }

    /**
     * Selects the posts from a given author model.
     *
     * @param  Model  $model  The Author model which you want to select the
     *                        posts from.
     * @return $this
     */
    public function fromAuthor(Model $model): self
    {
        return $this->where('author_id', '=', $model->getKey());
    }
}
