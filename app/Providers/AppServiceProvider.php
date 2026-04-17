<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- ОБЯЗАТЕЛЬНО ДОБАВЬ ЭТУ СТРОКУ

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
        // Если сайт запущен в облаке (production), принудительно используем HTTPS
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}