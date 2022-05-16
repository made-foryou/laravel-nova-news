<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use MennoTempelaar\NovaNewsTool\Events\SavingPost;
use MennoTempelaar\NovaNewsTool\Models\Post;
use MennoTempelaar\NovaNewsTool\Tests\TestCase;

use function Pest\Faker\faker;


uses(TestCase::class);
uses(RefreshDatabase::class);

test('fires an event when saving an post', function () {

    Event::fake([
        SavingPost::class,
    ]);

    $post = Post::factory()->create();

    Event::assertDispatched(
        SavingPost::class,
        function ($event) use ($post) {
            return $event->post->title === $post->title;
        },
    );

});

test('generates a slug from', function (string $title) {

    $post = Post::factory()->create(['title' => $title]);

    expect($post->slug)->toBe(Str::slug($title));

    $post = Post::factory()->create(['title' => $title]);

    expect($post->slug)->toBe(Str::slug($title) . '-1');

    $post = Post::factory()->create(['title' => $title]);

    expect($post->slug)->toBe(Str::slug($title) . '-2');

})
    ->with('post_titles');
