<?php

namespace MennoTempelaar\NovaNewsTool\Tests;

use MennoTempelaar\NovaNewsTool\NewsServiceProvider;


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
        ];

    }

    protected function getEnvironmentSetUp ( $app )
    {

        // perform environment setup

    }

}
