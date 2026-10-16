<?php

namespace App\Providers;

use App\Support\Landing;
use Illuminate\Support\Facades\View;
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
        // Destinos dos botões da landing (WhatsApp, redes sociais, portal).
        View::share('landing', new Landing);
    }
}
