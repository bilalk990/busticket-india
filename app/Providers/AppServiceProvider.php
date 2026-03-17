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

        // Register CurrencyHelper as a global helper
        if (!function_exists('currency_convert')) {
            function currency_convert($amount, $fromCurrency, $toCurrency = null, $exchangeRates = null) {
                return CurrencyHelper::convertCurrency($amount, $fromCurrency, $toCurrency, $exchangeRates);
            }
        }

        if (!function_exists('currency_format')) {
            function currency_format($amount, $currency = null, $exchangeRates = null) {
                return CurrencyHelper::formatCurrency($amount, $currency, $exchangeRates);
            }
        }

        if (!function_exists('currency_convert_and_format')) {
            function currency_convert_and_format($amount, $fromCurrency, $toCurrency = null, $exchangeRates = null) {
                return CurrencyHelper::convertAndFormat($amount, $fromCurrency, $toCurrency, $exchangeRates);
            }
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
