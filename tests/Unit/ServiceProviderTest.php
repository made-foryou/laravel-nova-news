<?php

use MennoTempelaar\NovaNewsTool\NewsServiceProvider;

uses(\MennoTempelaar\NovaNewsTool\Tests\TestCase::class);

test('It creates', function (  ) {
    $provider = new NewsServiceProvider($this->app);

    expect($provider)->toBeInstanceOf(NewsServiceProvider::class);
});
