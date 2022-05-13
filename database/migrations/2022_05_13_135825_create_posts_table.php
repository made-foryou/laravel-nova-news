<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use MennoTempelaar\NovaNewsTool\Utils\Prefixer;


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
            Prefixer::withPrefix('posts'),
            function (Blueprint $table) {

                $table->id();

                $table->string('title'); // Field with tooltip for max 70 characters

                $table->string('image')
                    ->nullable();

                $table->text('contents');

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
        Schema::dropIfExists(Prefixer::withPrefix('posts'));
    }

};
