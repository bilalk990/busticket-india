<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class ClearAllCaches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-all {--force : Force clear without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all application caches including route, config, view, and application caches';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->option('force') && !$this->confirm('This will clear all caches. Are you sure?')) {
            $this->info('Cache clearing cancelled.');
            return;
        }

        $this->info('Clearing all caches...');

        // Clear Laravel caches
        $this->call('cache:clear');
        $this->call('config:clear');
        $this->call('route:clear');
        $this->call('view:clear');
        $this->call('optimize:clear');

        // Clear application-specific caches
        $this->clearApplicationCaches();

        $this->info('All caches cleared successfully!');
    }

    private function clearApplicationCaches()
    {
        $this->info('Clearing application-specific caches...');

        // Clear home page caches
        Cache::forget('agencies_with_routes');
        Cache::forget('bus_fares_home');
        Cache::forget('top_routes_home');
        Cache::forget('discount_codes_home');

        // Clear search caches (pattern-based)
        $keys = Cache::get('cache_keys', []);
        foreach ($keys as $key) {
            if (str_starts_with($key, 'search_')) {
                Cache::forget($key);
            }
        }

        // Clear user dashboard caches (pattern-based)
        $userKeys = Cache::get('user_cache_keys', []);
        foreach ($userKeys as $key) {
            if (str_starts_with($key, 'user_dashboard_')) {
                Cache::forget($key);
            }
        }

        // Clear locale caches (pattern-based)
        $localeKeys = Cache::get('locale_cache_keys', []);
        foreach ($localeKeys as $key) {
            if (str_starts_with($key, 'user_locale_')) {
                Cache::forget($key);
            }
        }

        $this->info('Application caches cleared.');
    }
}
