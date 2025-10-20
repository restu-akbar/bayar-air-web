<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

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
        Validator::replacer('max', function ($message, $attribute, $rule, $parameters) {
            if (strpos($message, ':mb') === false) {
                return $message;
            }

            $maxKb = $parameters[0] ?? null;
            $mb = $maxKb ? round($maxKb / 1024, 2) : 0;

            return str_replace(':mb', $mb, $message);
        });
    }
}
