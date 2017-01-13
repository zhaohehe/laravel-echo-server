<?php

/*
 * Sometime too hot the eye of heaven shines
 */

namespace EchoServer;

use Illuminate\Support\ServiceProvider;

class BroadcastServerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/echo.php' => config_path('echo.php'),
        ]);
    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/echo.php', 'echo'
        );
        $this->commands([
            Commands\EchoCommand::class,
        ]);
    }
}