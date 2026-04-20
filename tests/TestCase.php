<?php

namespace Imv\Gateway\Tests;

use Imv\Gateway\GatewayServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelData\LaravelDataServiceProvider;

class TestCase extends Orchestra
{
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('cache.default', 'array');
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelDataServiceProvider::class,
            GatewayServiceProvider::class,
        ];
    }
}
