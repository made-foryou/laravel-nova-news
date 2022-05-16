<?php

namespace MennoTempelaar\NovaNewsTool\Tests;

use MennoTempelaar\NovaNewsTool\Providers\NewsServiceProvider;
use MennoTempelaar\NovaNewsTool\Providers\NewsEventsServiceProvider;
use MennoTempelaar\NovaNewsTool\Providers\NewsNovaServiceProvider;


class TestCase extends \Orchestra\Testbench\TestCase
{

    protected function setUp (): void
    {

        parent::setUp();

        // Additional setup

    }

    protected function getPackageProviders ( $app ): array
    {

        return [
            NewsServiceProvider::class,
            NewsEventsServiceProvider::class,
            NewsNovaServiceProvider::class,
        ];

    }

    protected function getEnvironmentSetUp ( $app )
    {

        // perform environment setup

    }

}
