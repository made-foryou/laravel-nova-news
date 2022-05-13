<?php

namespace MennoTempelaar\NovaNewsTool\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MennoTempelaar\NovaNewsTool\Database\Factories\PostFactory;
use MennoTempelaar\NovaNewsTool\Utils\Prefixer;


class Post extends Model
{

    use HasFactory;
    use SoftDeletes;


    /**
     * @inheritdoc
     */
    protected $dates = [
        'published_at',
        'published_till',
        'updated_at',
        'created_at',
        'deleted_at'
    ];


    /**
     * @inheritdoc
     */
    protected $guarded = [];

    /**
     * @inheritdoc
     */
    public function getTable (): string
    {

        return Prefixer::withPrefix('posts');

    }

    /**
     * @inheritdoc
     */
    protected static function newFactory (): Factory
    {

        return PostFactory::new();

    }

}
