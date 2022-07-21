<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Nova\Nova;
use Bondgenoot\NovaNewsTool\Nova\PostResource;
use Bondgenoot\NovaNewsTool\Providers\NewsNovaServiceProvider;


uses(RefreshDatabase::class);

test('It creates the nova service provider', function () {

    $provider = new NewsNovaServiceProvider($this->app);

    expect($provider)->toBeInstanceOf(NewsNovaServiceProvider::class);

});

test('It registers the resource', function () {

    expect(in_array(PostResource::class, Nova::$resources))->toBeTrue();

});
