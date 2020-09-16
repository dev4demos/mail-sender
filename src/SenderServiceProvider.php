<?php

declare (strict_types = 1);

namespace Mail\Sender;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class SenderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $router->aliasMiddleware('sender', \Mail\Sender\Middleware\SenderMiddleware::class);

        $this->publishes([
            __DIR__ . '/Config/sender.php' => config_path('sender.php')
        ], 'sender_config');

        // $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');

        $this->loadRoutesFrom(__DIR__ . '/Routes/api.php');

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        $this->loadTranslationsFrom(__DIR__ . '/Translations', 'sender');

        $this->publishes([
            __DIR__ . '/Translations' => resource_path('lang/vendor/sender')
        ]);

        $this->loadViewsFrom(__DIR__ . '/Views', 'sender');

        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/sender')
        ]);

        $this->publishes([
            __DIR__ . '/Assets' => public_path('vendor/sender')
        ], 'sender_assets');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Mail\Sender\Commands\SenderCommand::class
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/sender.php', 'sender'
        );
    }
}
