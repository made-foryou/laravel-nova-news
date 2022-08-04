<?php

namespace Bondgenoot\NovaNewsTool\Facades;

use Bondgenoot\NovaNewsTool\Models\PostModel;
use Bondgenoot\NovaNewsTool\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;

/**
 * News Facade
 * ------------------------------------------------------------------------
 *
 * Object to be used from the project which imports this package.
 *
 * @method  static  Collection<PostModel>  forOverview()
 * @method  static  Collection<PostModel>  forPreview(int $limit = 3)
 * @method  static  News                   fromAuthor(Model $model)
 */
class News extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor(): string
    {
        return PostRepository::class;
    }
}
