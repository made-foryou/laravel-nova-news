<?php

namespace Bondgenoot\NovaNewsTool\Models;

use Advoor\NovaEditorJs\NovaEditorJsCast;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Carbon;
use Bondgenoot\NovaNewsTool\Database\Factories\PostFactory;
use Bondgenoot\NovaNewsTool\Events\CreatingPostEvent;
use Bondgenoot\NovaNewsTool\Events\SavingPostEvent;
use Bondgenoot\NovaNewsTool\Utils\Prefix;


/**
 * @property-read int $id
 * @property string $title
 * @property string $slug
 * @property string $image
 * @property string $contents
 * @property bool $hidden
 * @property Carbon $published_at
 * @property Carbon $published_till
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property Carbon $deleted_at
 * @property int $created_by
 *
 * @property User $createdBy
 * @property User $author
 */
class PostModel extends Model
{

    use HasFactory;
    use SoftDeletes;


    /**
     * @var array<string, CastsAttributes|string>
     * @inheritdoc
     */
    protected $casts = [
        'contents'       => NovaEditorJsCast::class,
        'published_at'   => 'datetime',
        'published_till' => 'datetime',
        'updated_at'     => 'datetime',
        'created_at'     => 'datetime',
        'deleted_at'     => 'datetime',
    ];

    /**
     * @var array<string, string>
     * @inheritdoc
     */
    protected $dispatchesEvents = [
        'saving'   => SavingPostEvent::class,
        'creating' => CreatingPostEvent::class,
    ];

    /**
     * @inheritdoc
     */
    protected $guarded = [];

    public function author(): BelongsTo
    {

        return $this->belongsTo(
            Prefix::config('author.model'),
            'author_id',
            'id'
        );

    }

    public function createdBy(): BelongsTo
    {

        return $this->belongsTo(User::class, 'created_by');

    }

    /**
     * @inheritdoc
     */
    public function getTable(): string
    {

        return Prefix::withPrefix('posts');

    }

    /**
     * @inheritdoc
     */
    protected static function newFactory(): Factory
    {

        return PostFactory::new();

    }

}
