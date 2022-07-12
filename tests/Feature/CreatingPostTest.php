<?php

use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MennoTempelaar\NovaNewsTool\Models\PostModel;
use Orchestra\Testbench\Factories\UserFactory;


uses( RefreshDatabase::class );

beforeEach( function () {

    $user = ( new UserFactory() )->create();

    actingAs( $user );

} );

it( 'associates the active user to the post' )
    ->expect( fn () => PostModel::factory()->create() )
    ->createdBy->toBeInstanceOf( User::class );
