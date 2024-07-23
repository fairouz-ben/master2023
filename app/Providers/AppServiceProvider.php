<?php

namespace App\Providers;

use App\Models\AppConfig;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Define the function here
        $this->app->singleton('configuration', function () {
            return new class {
                public function getConfigurationValue($key)
                {
                    $value = Cache::get('configuration_' . $key);

                    if (!$value) {
                        $configuration = AppConfig::where('key', $key)->first();
                        $value = $configuration ? $configuration->value : null; // Handle missing configuration

                        // Cache the value for subsequent requests
                       // Cache::put('configuration_' . $key, $value, now()->addMinutes(60), ['configuration']);

                        Cache::put('configuration_' . $key, $value, now()->addDay(1), ['configuration']); // Adjust cache expiration as needed
                    }

                    return $value;
                }
            };
        });
    }
}
