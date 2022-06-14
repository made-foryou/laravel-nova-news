<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use MennoTempelaar\NovaNewsTool\Utils\Prefix;


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
