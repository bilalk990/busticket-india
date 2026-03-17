<?php

use App\Helpers\CurrencyHelper;

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
