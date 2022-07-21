<?php

namespace Bondgenoot\NovaNewsTool\Tests;

use Bondgenoot\NovaNewsTool\Providers\NewsServiceProvider;
use Bondgenoot\NovaNewsTool\Providers\NewsEventsServiceProvider;
use Bondgenoot\NovaNewsTool\Providers\NewsNovaServiceProvider;
use \Orchestra\Testbench\TestCase as Orchestra;


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
