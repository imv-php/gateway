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
        $app['config']->set('gateway.base_url', 'https://gateway.imv.uz');
        $app['config']->set('gateway.username', 'dxsh');
        $app['config']->set('gateway.password', 'EDo09tiW9sXsXbicl4yO15LTR');
        $app['config']->set('gateway.cache_key', 'gateway_tokens');
        $app['config']->set('gateway.connect_timeout', 15);
        $app['config']->set('gateway.request_timeout', 30);
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelDataServiceProvider::class,
            GatewayServiceProvider::class,
        ];
    }
}
