<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use MennoTempelaar\NovaNewsTool\Events\SavingPostEvent;
use MennoTempelaar\NovaNewsTool\Models\PostModel;
use Orchestra\Testbench\Factories\UserFactory;


uses( RefreshDatabase::class );

beforeEach(function () {

    $user = (new UserFactory())->create();

    actingAs($user);

});

test( 'fires an event when saving a post', function () {

    Event::fake( [
        SavingPostEvent::class,
    ] );

    /** @var PostModel $post */
    $post = PostModel::factory()->create();

    Event::assertDispatched(
        SavingPostEvent::class,
        function ( $event ) use ( $post ) {

            return $event->post->title === $post->title;

        },
    );

} );

test( 'generates a slug from', function ( string $title ) {

    $post = PostModel::factory()->create( [ 'title' => $title ] );

    expect( $post->slug )->toBe( Str::slug( $title ) );

    $post = PostModel::factory()->create( [ 'title' => $title ] );

    expect( $post->slug )->toBe( Str::slug( $title ) . '-1' );

    $post = PostModel::factory()->create( [ 'title' => $title ] );

    expect( $post->slug )->toBe( Str::slug( $title ) . '-2' );

} )
    ->with( 'post_titles' );
