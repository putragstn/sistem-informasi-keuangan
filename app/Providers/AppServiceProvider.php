<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        //


        // Custom Curencry Rupiah
        Blade::directive('currency', function ($expression) {
            return "Rp. {{ number_format($expression,0,',','.'); }}";
        });
    }
}
