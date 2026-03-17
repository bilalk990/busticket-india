<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearInternetCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'internet:clear-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the internet connection status cache';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Cache::forget('internet_connection_status');
        $this->info('Internet connection cache cleared successfully.');
        
        return Command::SUCCESS;
    }
} 