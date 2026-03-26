<?php

use App\Helpers\CurrencyHelper;

if (!function_exists('agency_logo_url')) {
    /**
     * Resolve agency logo URL.
     * Handles both full URLs (stored from Node.js backend) and plain filenames.
     */
    function agency_logo_url(?string $logo): string
    {
        if (empty($logo)) {
            return '';
        }
        // Already a full URL (http/https)
        if (str_starts_with($logo, 'http')) {
            return $logo;
        }
        // Legacy plain filename
        return 'http://127.0.0.1:8001/assets/images/agency/logo/' . $logo;
    }
}

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
