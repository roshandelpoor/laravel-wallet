<?php

namespace Roshandelpoor\LaravelWallet\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelWalletServiceProvider extends ServiceProvider
{
    /**
     * Register files.
     */
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/../../config/laravel-wallet.php', 'laravel-wallet');
    }

    /**
     * Boot application.
     */
    public function boot(): void
    {
        // Publish Config
        $this->publishes([
            __DIR__ . '/../../config/laravel-wallet.php' => config_path('laravel-wallet.php'),
        ], 'laravel-wallet-config');

        // Publish Migrations
        $this->publishes([
            __DIR__ . '/../../database/migrations' => database_path('migrations'),
        ], 'laravel-wallet-migrations');
    }
}
