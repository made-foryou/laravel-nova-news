<?php

use Bondgenoot\NovaNewsTool\Utils\Prefix;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            Prefix::withPrefix('posts'),
            function (Blueprint $table) {
                $table->id();

                $table->string('title', 120);

                $table->string('slug')
                    ->nullable();

                $table->string('image')
                    ->nullable();

                $table->text('contents')
                    ->nullable();

                $table->boolean('hidden')
                    ->default(false);

                $table->timestamp('published_at')
                    ->nullable();

                $table->timestamp('published_till')
                    ->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->unsignedBigInteger('created_by');

                if (! DB::connection() instanceof SQLiteConnection) {
                    $model = config('auth.providers.users.model');
                    /** @var Model $model */
                    $model = new $model();

                    $table->foreign('created_by')
                        ->references($model->getKeyName())
                        ->on($model->getTable())
                        ->onDelete('RESTRICT');
                }
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(Prefix::withPrefix('posts'));
    }
};
