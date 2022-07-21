<?php

use Bondgenoot\NovaNewsTool\Utils\Prefix;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(
            Prefix::withPrefix('posts'),
            function (Blueprint $table) {
                $table->unsignedBigInteger('author_id')
                    ->nullable()
                    ->after('contents');

                $model = Prefix::config('author.model');

                /** @var Model $model */
                $model = new $model();

                $table->foreign('author')
                    ->references($model->getKeyName())
                    ->on($model->getTable())
                    ->onDelete('SET NULL');
            }
        );
    }

    public function down(): void
    {
        Schema::table(
            Prefix::withPrefix('posts'),
            function (Blueprint $table) {
                $table->dropForeign('author_id');
            },
        );

        Schema::table(
            Prefix::withPrefix('posts'),
            function (Blueprint $table) {
                $table->dropColumn('author_id');
            },
        );
    }
};
