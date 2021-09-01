<?php

namespace Okipa\LaravelBootstrapComponents\Tests;

use Faker\Factory;
use Okipa\LaravelBootstrapComponents\ComponentServiceProvider;
use Orchestra\Testbench\TestCase;

abstract class BootstrapComponentsTestCase extends TestCase
{
    protected \Faker\Generator $faker;

    protected function getEnvironmentSetUp($app): void
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    protected function getPackageProviders($app): array
    {
        return [ComponentServiceProvider::class];
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->faker = Factory::create();
    }
}
