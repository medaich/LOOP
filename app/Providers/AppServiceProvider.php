<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Suppress deprecation warnings specifically for PHP 8.5 compatibility issues in Laravel 11
        if (PHP_VERSION_ID >= 80500) {
            error_reporting(E_ALL & ~E_DEPRECATED);
        }
    }
}
