<?php

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store' => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */
        SimpleSoftwareIO\QrCode\QrCodeServiceProvider::class,

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
    ])->toArray(),

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // 'Example' => App\Facades\Example::class,
        'QrCode' => SimpleSoftwareIO\QrCode\Facades\QrCode::class,
    ])->toArray(),

    /*
    |--------------------------------------------------------------------------
    | Application Locales
    |--------------------------------------------------------------------------
    |
    | Available locales for the application with their display names and flags.
    |
    */

    'locales' => [
        'en' => ['name' => 'English (US)', 'flag' => 'us.svg'], // United States
        'ru' => ['name' => 'Русский', 'flag' => 'ru.svg'], // Russia
        'fr' => ['name' => 'Français', 'flag' => 'fr.svg'], // France
        'sq' => ['name' => 'Shqip', 'flag' => 'al.svg'], // Albanian
        'sr' => ['name' => 'Српски', 'flag' => 'rs.svg'], // Serbian
        'mk' => ['name' => 'Македонски', 'flag' => 'mk.svg'], // North Macedonia
        'me' => ['name' => 'Crnogorski', 'flag' => 'me.svg'], // Montenegro
        'bs' => ['name' => 'Bosanski', 'flag' => 'ba.svg'], // Bosnia and Herzegovina
        // 'ar' => ['name' => 'العربية', 'flag' => 'sa.svg'], // Saudi Arabia
        // 'af' => ['name' => 'Afrikaans', 'flag' => 'za.svg'], // South Africa
        // 'id' => ['name' => 'Bahasa Indonesia', 'flag' => 'id.svg'], // Indonesia
        // 'bn' => ['name' => 'বাংলা', 'flag' => 'bd.svg'], // Bangladesh
        // 'bg' => ['name' => 'Български', 'flag' => 'bg.svg'], // Bulgaria
        // 'zh' => ['name' => '中文', 'flag' => 'cn.svg'], // China
        // 'cs' => ['name' => 'Čeština', 'flag' => 'cz.svg'], // Czech Republic
        // 'da' => ['name' => 'Dansk', 'flag' => 'dk.svg'], // Denmark
        // 'de' => ['name' => 'Deutsch', 'flag' => 'de.svg'], // Germany
        // 'en-uk' => ['name' => 'English (UK)', 'flag' => 'gb.svg'], // United Kingdom
        // 'es' => ['name' => 'Español', 'flag' => 'es.svg'], // Spain
        // 'fi' => ['name' => 'Suomi', 'flag' => 'fi.svg'], // Finland
        // 'hi' => ['name' => 'हिन्दी', 'flag' => 'in.svg'], // India
        // 'hr' => ['name' => 'Hrvatski', 'flag' => 'hr.svg'], // Croatia
        // 'hu' => ['name' => 'Magyar', 'flag' => 'hu.svg'], // Hungary
        // 'it' => ['name' => 'Italiano', 'flag' => 'it.svg'], // Italy
        // 'ja' => ['name' => '日本語', 'flag' => 'jp.svg'], // Japan
        // 'ko' => ['name' => '한국어', 'flag' => 'kr.svg'], // South Korea
        // 'ms' => ['name' => 'Melayu', 'flag' => 'my.svg'], // Malaysia
        // 'nl' => ['name' => 'Nederlands', 'flag' => 'nl.svg'], // Netherlands
        // 'no' => ['name' => 'Norsk', 'flag' => 'no.svg'], // Norway
        // 'pl' => ['name' => 'Polski', 'flag' => 'pl.svg'], // Poland
        // 'pt-pt' => ['name' => 'Português', 'flag' => 'pt.svg'], // Portugal
        // 'ro' => ['name' => 'Român', 'flag' => 'ro.svg'], // Romania
        // 'sw' => ['name' => 'Kiswahili', 'flag' => 'tz.svg'], // Tanzania
        // 'sv' => ['name' => 'Svenska', 'flag' => 'se.svg'], // Sweden
        // 'tr' => ['name' => 'Türkçe', 'flag' => 'tr.svg'], // Turkey
        // 'vi' => ['name' => 'Tiếng Việt', 'flag' => 'vn.svg'], // Vietnam
    ],

    /*
    |--------------------------------------------------------------------------
    | Bus Travel Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration settings for bus travel requirements and restrictions.
    |
    */

    'bus_travel' => [
        'minimum_age' => env('BUS_MINIMUM_AGE', 5), // Minimum age in years for bus travel
    ],

];
