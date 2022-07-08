<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use MennoTempelaar\NovaNewsTool\Events\SavingPost;
use MennoTempelaar\NovaNewsTool\Models\PostModel;
use Orchestra\Testbench\Factories\UserFactory;


uses( RefreshDatabase::class );

test( 'fires an event when saving an post', function () {

    Event::fake( [
        SavingPost::class,
    ] );

    $post = PostModel::factory()
        ->for( ( new UserFactory() )->create(), 'createdBy' )
        ->create();

    Event::assertDispatched(
        SavingPost::class,
        function ( $event ) use ( $post ) {

            return $event->post->title === $post->title;
        },
    );

} );

test( 'generates a slug from', function ( string $title ) {

    $post = PostModel::factory()
        ->for( ( new UserFactory() )->create(), 'createdBy' )
        ->create( [ 'title' => $title ] );

    expect( $post->slug )->toBe( Str::slug( $title ) );

    $post = PostModel::factory()
        ->for( ( new UserFactory() )->create(), 'createdBy' )
        ->create( [ 'title' => $title ] );

    expect( $post->slug )->toBe( Str::slug( $title ) . '-1' );

    $post = PostModel::factory()
        ->for( ( new UserFactory() )->create(), 'createdBy' )
        ->create( [ 'title' => $title ] );

    expect( $post->slug )->toBe( Str::slug( $title ) . '-2' );

} )
    ->with( 'post_titles' );
