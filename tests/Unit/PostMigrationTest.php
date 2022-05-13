<?php

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MennoTempelaar\NovaNewsTool\Models\Post;
use MennoTempelaar\NovaNewsTool\Tests\TestCase;


uses(TestCase::class);
uses(RefreshDatabase::class);

it('has a title')
    ->expect(fn () => Post::factory()->create())
    ->title->toBeString();

it('has contents')
    ->expect(fn () => Post::factory()->create())
    ->contents->toBeString();

it('has an image')
    ->expect(fn () => Post::factory()->create())
    ->contents->toBeString();

it('has a hidden column')
    ->expect(fn () => Post::factory()->create())
    ->hidden->toBeBool();

it('has a published_at date')
    ->expect(fn () => Post::factory()->create())
    ->published_at->toBeInstanceOf(Carbon::class);

it('has a published_till date')
    ->expect(fn () => Post::factory()->create())
    ->published_till->toBeInstanceOf(Carbon::class);

it('could not have a published_till date')
    ->expect(fn () => Post::factory()->create([ 'published_till' => null ]))
    ->published_till->toBeNull();

it('has a updated_at date')
    ->expect(fn () => Post::factory()->create())
    ->updated_at->toBeInstanceOf(Carbon::class);

it('has a created_at date')
    ->expect(fn () => Post::factory()->create())
    ->created_at->toBeInstanceOf(Carbon::class);

it('has not a deleted_at date when not deleted')
    ->expect(fn () => Post::factory()->create())
    ->deleted_at->toBeNull();

it('has a deleted_at date when deleted')
    ->expect(function () {
        $post = Post::factory()->create();
        $post->delete();
        return $post;
    })->deleted_at->toBeInstanceOf(Carbon::class);
