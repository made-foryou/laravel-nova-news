<?php

use Bondgenoot\NovaNewsTool\Facades\News;
use Bondgenoot\NovaNewsTool\Models\PostModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Orchestra\Testbench\Factories\UserFactory;

uses(DatabaseMigrations::class);
uses(RefreshDatabase::class);

beforeEach(function () {
    $user = (new UserFactory())->create();

    actingAs($user);
});

it('retrieves the posts for overview', function () {
    expect(News::forOverview())->toBeInstanceOf(Collection::class);

    PostModel::factory()->create([
        'published_at' => Carbon::now()->subDays(10),
        'published_till' => Carbon::now()->addDays(10),
        'hidden' => false,
    ]);

    expect(News::forOverview()->get(0))
        ->toBeInstanceOf(PostModel::class)
        ->and(News::forOverview()->count())
        ->toBe(1);

    PostModel::factory()->create([
        'published_at' => Carbon::now()->subDays(10),
        'published_till' => null,
        'hidden' => false,
    ]);

    expect(News::forOverview()->get(0))
        ->toBeInstanceOf(PostModel::class)
        ->and(News::forOverview()->count())
        ->toBe(2);

    PostModel::factory()->create([
        'published_at' => Carbon::now()->subDays(10),
        'published_till' => Carbon::now()->subDays(4),
        'hidden' => false,
    ]);

    expect(News::forOverview()->get(0))
        ->toBeInstanceOf(PostModel::class)
        ->and(News::forOverview()->count())
        ->toBe(2);

    PostModel::factory()->create([
        'published_at' => Carbon::now()->addDays(4),
        'published_till' => Carbon::now()->addDays(6),
        'hidden' => false,
    ]);

    expect(News::forOverview()->get(0))
        ->toBeInstanceOf(PostModel::class)
        ->and(News::forOverview()->count())
        ->toBe(2);

    PostModel::factory()->create([
        'published_at' => Carbon::now()->subDays(4),
        'published_till' => Carbon::now()->addDays(6),
        'hidden' => true,
    ]);

    expect(News::forOverview()->get(0))
        ->toBeInstanceOf(PostModel::class)
        ->and(News::forOverview()->count())
        ->toBe(2);
});

it('retrieves the posts amount for preview', function () {
    expect(News::forPreview())
        ->toBeInstanceOf(Collection::class);

    PostModel::factory()->create([
        'published_at' => Carbon::now()->subDays(10),
        'published_till' => Carbon::now()->addDays(10),
        'hidden' => false,
    ]);
    PostModel::factory()->create([
        'published_at' => Carbon::now()->subDays(10),
        'published_till' => Carbon::now()->addDays(10),
        'hidden' => false,
    ]);
    PostModel::factory()->create([
        'published_at' => Carbon::now()->subDays(10),
        'published_till' => Carbon::now()->addDays(10),
        'hidden' => false,
    ]);
    PostModel::factory()->create([
        'published_at' => Carbon::now()->subDays(10),
        'published_till' => Carbon::now()->addDays(10),
        'hidden' => false,
    ]);

    expect(News::forPreview())
        ->toBeInstanceOf(Collection::class)
        ->count()
        ->toBe(3)
        ->and(News::forOverview()->count())->toBe(4);

    PostModel::factory()->create([
        'published_at' => Carbon::now()->subDays(4),
        'published_till' => Carbon::now()->addDays(6),
        'hidden' => true,
    ]);
    PostModel::factory()->create([
        'published_at' => Carbon::now()->subDays(10),
        'published_till' => Carbon::now()->subDays(4),
        'hidden' => false,
    ]);
    PostModel::factory()->create([
        'published_at' => Carbon::now()->addDays(4),
        'published_till' => Carbon::now()->addDays(6),
        'hidden' => false,
    ]);

    expect(News::forPreview(5))
        ->count()
        ->toBe(4)
        ->and(News::forPreview(2)->count())
        ->toBe(2);
});

it('can retrieve the data from a single author', function () {
    /** @var User $user */
    $user = (new UserFactory())->create();

    PostModel::factory()->create([
        'author_id' => $user->id,
        'published_at' => Carbon::now()->subDays(10),
        'published_till' => Carbon::now()->addDays(10),
        'hidden' => false,
    ]);
    PostModel::factory()->create([
        'author_id' => $user->id,
        'published_at' => Carbon::now()->subDays(10),
        'published_till' => Carbon::now()->addDays(10),
        'hidden' => false,
    ]);
    PostModel::factory()->create([
        'published_at' => Carbon::now()->subDays(10),
        'published_till' => Carbon::now()->addDays(10),
        'hidden' => false,
    ]);
    PostModel::factory()->create([
        'published_at' => Carbon::now()->subDays(10),
        'published_till' => Carbon::now()->addDays(10),
        'hidden' => false,
    ]);
    PostModel::factory()->create([
        'published_at' => Carbon::now()->subDays(10),
        'published_till' => Carbon::now()->addDays(10),
        'hidden' => false,
    ]);

    $posts = News::fromAuthor($user)->forOverview();

    expect($posts->count())->toBe(2);

    foreach ($posts as $post) {
        expect($post)
            ->toBeInstanceOf(PostModel::class)
            ->author
            ->toBeInstanceOf(User::class)
            ->author->id
            ->toBe($user->id);
    }
});
