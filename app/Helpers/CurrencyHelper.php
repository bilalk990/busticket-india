<?php

namespace App\Helpers;

class CurrencyHelper
{
    /**
     * Convert amount from one currency to another using exchange rates
     */
    public static function convertCurrency($amount, $fromCurrency, $toCurrency, $exchangeRates = null)
    {
        if (!$amount || !$fromCurrency || !$toCurrency) {
            return $amount;
        }

        // If no exchange rates provided, get from session
        if (!$exchangeRates) {
            $exchangeRates = session('currency')['rates'] ?? [];
        }

        // If currencies are the same, return original amount
        if ($fromCurrency === $toCurrency) {
            return $amount;
        }

        // Get conversion rates
        $conversionRate = $exchangeRates[$fromCurrency] ?? 1; // From original currency to base (ZMW)
        $toSelectedCurrencyRate = $exchangeRates[$toCurrency] ?? 1; // From base to selected currency

        // Convert amount
        return ($amount / $conversionRate) * $toSelectedCurrencyRate;
    }

    /**
     * Format amount with currency symbol
     */
    public static function formatCurrency($amount, $currency = null, $exchangeRates = null)
    {
        if (!$currency) {
            $currency = session('currency')['code'] ?? 'ZMW';
        }

        // Get currency symbol mapping
        $symbols = [
            'EUR' => '€',
            'USD' => '$',
            'GBP' => '£',
            'ZMW' => 'ZK',
            'KES' => 'KSh',
            'NGN' => '₦',
            'GHS' => '₵',
            'UGX' => 'USh',
            'RWF' => 'RF',
            'TZS' => 'TSh',
            'MWK' => 'MK',
            'CHF' => 'CHF',
            'PLN' => 'zł',
            'CZK' => 'Kč',
            'SEK' => 'kr',
            'CNY' => '￥',
            'AUD' => 'A$',
            'CAD' => 'CA$',
            'MXN' => 'MX$',
            'DKK' => 'DKK',
            'INR' => '₹',
            'NOK' => 'NOK',
            'BRL' => 'R$',
            'JPY' => '¥',
            'RON' => 'L',
            'KRW' => '₩',
            'COP' => 'CO$',
            'UAH' => '₴',
            'HUF' => 'Ft',
            'CLP' => 'CL$',
            'BGN' => 'лв',
            'HRK' => 'kn',
            'XAF' => 'FCFA'
        ];

        $symbol = $symbols[$currency] ?? $currency;
        
        return $symbol . ' ' . number_format($amount, 2);
    }

    /**
     * Convert and format amount to selected currency
     */
    public static function convertAndFormat($amount, $fromCurrency, $toCurrency = null, $exchangeRates = null)
    {
        if (!$toCurrency) {
            $toCurrency = session('currency')['code'] ?? 'ZMW';
        }

        $convertedAmount = self::convertCurrency($amount, $fromCurrency, $toCurrency, $exchangeRates);
        return self::formatCurrency($convertedAmount, $toCurrency);
    }

    /**
     * Get current selected currency
     */
    public static function getSelectedCurrency()
    {
        return session('currency')['code'] ?? 'ZMW';
    }

    /**
     * Get exchange rates from session
     */
    public static function getExchangeRates()
    {
        return session('currency')['rates'] ?? [];
    }
} 
