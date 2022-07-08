<?php

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MennoTempelaar\NovaNewsTool\Models\PostModel;
use Orchestra\Testbench\Factories\UserFactory;


uses( RefreshDatabase::class );

it( 'has a title' )
    ->expect(
        fn () => PostModel::factory()
            ->for( ( new UserFactory() )->create(), 'createdBy' )
            ->create(),
    )
    ->title->toBeString();

it( 'has contents' )
    ->expect(
        fn () => PostModel::factory()
            ->for( ( new UserFactory() )->create(), 'createdBy' )
            ->create(),
    )
    ->contents->toBeString();

it( 'has an image' )
    ->expect(
        fn () => PostModel::factory()
            ->for( ( new UserFactory() )->create(), 'createdBy' )
            ->create(),
    )
    ->contents->toBeString();

it( 'has a hidden column' )
    ->expect(
        fn () => PostModel::factory()
            ->for( ( new UserFactory() )->create(), 'createdBy' )
            ->create(),
    )
    ->hidden->toBeBool();

it( 'has a published_at date' )
    ->expect(
        fn () => PostModel::factory()
            ->for( ( new UserFactory() )->create(), 'createdBy' )
            ->create(),
    )
    ->published_at->toBeInstanceOf( Carbon::class );

it( 'has a published_till date' )
    ->expect(
        fn () => PostModel::factory()
            ->for( ( new UserFactory() )->create(), 'createdBy' )
            ->create(),
    )
    ->published_till->toBeInstanceOf( Carbon::class );

it( 'could not have a published_till date' )
    ->expect(
        fn () => PostModel::factory()
            ->for( ( new UserFactory() )->create(), 'createdBy' )
            ->create( [
                'published_till' => null,
            ] ),
    )
    ->published_till->toBeNull();

it( 'has a updated_at date' )
    ->expect(
        fn () => PostModel::factory()
            ->for( ( new UserFactory() )->create(), 'createdBy' )
            ->create(),
    )
    ->updated_at->toBeInstanceOf( Carbon::class );

it( 'has a created_at date' )
    ->expect(
        fn () => PostModel::factory()
            ->for( ( new UserFactory() )->create(), 'createdBy' )
            ->create(),
    )
    ->created_at->toBeInstanceOf( Carbon::class );

it( 'has a createdBy user' )
    ->expect(
        fn () => PostModel::factory()
            ->for( ( new UserFactory() )->create(), 'createdBy' )
            ->create(),
    )
    ->createdBy->toBeInstanceOf( User::class );

it( 'has not a deleted_at date when not deleted' )
    ->expect(
        fn () => PostModel::factory()
            ->for( ( new UserFactory() )->create(), 'createdBy' )
            ->create(),
    )
    ->deleted_at->toBeNull();

it( 'has a deleted_at date when deleted' )
    ->expect(
        function () {

            $post = PostModel::factory()
                ->for( ( new UserFactory() )->create(), 'createdBy' )
                ->create();

            $post->delete();

            return $post;

        },
    )
    ->deleted_at->toBeInstanceOf( Carbon::class );
