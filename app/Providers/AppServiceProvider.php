<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Blade;
use App\Helpers\CurrencyHelper;

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
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        // Register Blade directives for currency conversion
        Blade::directive('currency', function ($expression) {
            return "<?php echo \App\Helpers\CurrencyHelper::convertAndFormat($expression); ?>";
        });

        Blade::directive('currencyConvert', function ($expression) {
            return "<?php echo \App\Helpers\CurrencyHelper::convertCurrency($expression); ?>";
        });

        Blade::directive('currencyFormat', function ($expression) {
            return "<?php echo \App\Helpers\CurrencyHelper::formatCurrency($expression); ?>";
        });

        // Monitor slow database queries
        DB::listen(function ($query) {
            if ($query->time > 100) { // Log queries taking more than 100ms
                Log::warning('Slow query detected', [
                    'sql' => $query->sql,
                    'time' => $query->time . 'ms',
                    'bindings' => $query->bindings,
                    'connection' => $query->connection->getName()
                ]);
            }
        });
    }
}
