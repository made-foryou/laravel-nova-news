<?php

use Laravel\Nova\Nova;
use MennoTempelaar\NovaNewsTool\Nova\PostResource;
use MennoTempelaar\NovaNewsTool\Providers\NewsNovaServiceProvider;
use MennoTempelaar\NovaNewsTool\Tests\TestCase;


uses( TestCase::class );

test( 'It creates the nova service provider', function () {

    $provider = new NewsNovaServiceProvider( $this->app );

    expect( $provider )->toBeInstanceOf( NewsNovaServiceProvider::class );

} );

test( 'It registers the resource', function () {

    expect( in_array(PostResource::class, Nova::$resources) )->toBeTrue();

});
