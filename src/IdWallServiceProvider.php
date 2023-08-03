<?php

namespace WeDevBr\IdWall;

use Illuminate\Support\ServiceProvider;

class IdWallServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/idwall.php' => config_path('idwall.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/idwall.php', 'idwall');

        // Register the main class to use with the facade
        $this->app->singleton('idwall', function () {
            return new IdWall();
        });
    }
}
