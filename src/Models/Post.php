<?php

namespace MennoTempelaar\NovaNewsTool\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MennoTempelaar\NovaNewsTool\Database\Factories\PostFactory;
use MennoTempelaar\NovaNewsTool\Events\SavingPost;
use MennoTempelaar\NovaNewsTool\Utils\Prefixer;


/**
 * @property-read int $id
 * @property string $title
 * @property string $slug
 */
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
        'deleted_at',
    ];

    /**
     * @var array<string, string>
     * @inheritdoc
     */
    protected $dispatchesEvents = [
        'saving' => SavingPost::class,
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
