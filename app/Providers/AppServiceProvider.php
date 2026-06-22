<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
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
        Blade::if('authGuard', function($guard) {
            return Auth::guard($guard)->check();
        });

        Carbon::setLocale('es');
        
        //con esta linea ayuda a que mis estillos se vean en ngrok y en local
        if (str_contains(request()->getHost(), 'ngrok')) {
            URL::forceScheme('https');
        }

         if (app()->environment('production')) {
        URL::forceScheme('https');
    }
        
    }
}
