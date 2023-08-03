<?php

namespace WeDevBr\IdWall\Tests;

use Dotenv\Dotenv;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Orchestra\Testbench\Concerns\CreatesApplication;
use WeDevBr\IdWall\IdWallServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function getPackageProviders($app): array
    {
        return [
            IdWallServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        $root = __DIR__ . '/../';
        $dotenv = Dotenv::createImmutable($root);
        $dotenv->safeLoad();
        $app['config']->set('cache.default', env('CACHE_DRIVER', 'file'));
        $app['config']->set('idwall.auth_token', env('IDWALL_AUTH_TOKEN', null));
        $app['config']->set('idwall.api_url', env('IDWALL_API_URL'));
    }
}
