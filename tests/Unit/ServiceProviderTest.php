<?php

use MennoTempelaar\NovaNewsTool\Providers\NewsEventsServiceProvider;
use MennoTempelaar\NovaNewsTool\Providers\NewsServiceProvider;
use MennoTempelaar\NovaNewsTool\Tests\TestCase;

uses(TestCase::class);

test('It creates the default service provider', function (  ) {
    $provider = new NewsServiceProvider($this->app);

    expect($provider)->toBeInstanceOf(NewsServiceProvider::class);
});

test('It creates the events service provider', function (  ) {
    $provider = new NewsEventsServiceProvider($this->app);

    expect($provider)->toBeInstanceOf(NewsEventsServiceProvider::class);
});
