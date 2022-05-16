<?php

use MennoTempelaar\NovaNewsTool\Providers\NewsEventsServiceProvider;
use MennoTempelaar\NovaNewsTool\Providers\NewsNovaServiceProvider;
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

test('It creates the nova service provider', function (  ) {
    $provider = new NewsNovaServiceProvider($this->app);

    expect($provider)->toBeInstanceOf(NewsNovaServiceProvider::class);
});
