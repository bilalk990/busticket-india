<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InternetConnectionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Clear internet connection cache when the application starts
        Cache::forget('internet_connection_status');
        
        // Schedule periodic internet connectivity checks
        if ($this->app->runningInConsole()) {
            return;
        }

        // Add a command to manually clear the cache
        $this->commands([
            \App\Console\Commands\ClearInternetCache::class,
        ]);
    }
} 
