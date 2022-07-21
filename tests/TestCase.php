<?php

namespace MennoTempelaar\NovaNewsTool\Tests;

use MennoTempelaar\NovaNewsTool\Providers\NewsEventsServiceProvider;
use MennoTempelaar\NovaNewsTool\Providers\NewsNovaServiceProvider;
use MennoTempelaar\NovaNewsTool\Providers\NewsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadLaravelMigrations();
    }

    protected function getPackageProviders($app): array
    {
        return [
            NewsServiceProvider::class,
            NewsEventsServiceProvider::class,
            NewsNovaServiceProvider::class,
        ];
    }
}
