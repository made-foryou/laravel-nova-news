<?php

namespace MennoTempelaar\NovaNewsTool\Models;

use Advoor\NovaEditorJs\NovaEditorJsCast;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Carbon;
use MennoTempelaar\NovaNewsTool\Database\Factories\PostFactory;
use MennoTempelaar\NovaNewsTool\Events\CreatingPostEvent;
use MennoTempelaar\NovaNewsTool\Events\SavingPostEvent;
use MennoTempelaar\NovaNewsTool\Utils\Prefix;


/**
 * @property-read int $id
 * @property string   $title
 * @property string   $slug
 * @property string   $image
 * @property string   $contents
 * @property bool     $hidden
 * @property Carbon   $published_at
 * @property Carbon   $published_till
 * @property Carbon   $updated_at
 * @property Carbon   $created_at
 * @property Carbon   $deleted_at
 * @property int      $created_by
 *
 * @property User     $createdBy
 */
class PostModel extends Model
{

    use HasFactory;
    use SoftDeletes;


    /**
     * @var string[]
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
     * @var array<string, CastsAttributes|string>
     * @inheritdoc
     */
    protected $casts = [
        'contents' => NovaEditorJsCast::class,
    ];

    /**
     * @var array<string, string>
     * @inheritdoc
     */
    protected $dispatchesEvents = [
        'saving' => SavingPostEvent::class,
        'creating' => CreatingPostEvent::class,
    ];

    /**
     * @inheritdoc
     */
    protected $guarded = [];

    public function createdBy(): BelongsTo
    {

        return $this->belongsTo(User::class, 'created_by');

    }

    /**
     * @inheritdoc
     */
    public function getTable (): string
    {

        return Prefix::withPrefix( 'posts' );

    }

    /**
     * @inheritdoc
     */
    protected static function newFactory (): Factory
    {

        return PostFactory::new();

    }

}
