<?php

namespace App\Providers;

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
        // Share infografis data with the eperpus layout
        view()->composer('layouts.eperpus', function ($view) {
            $infografis = \App\Models\Infografis::where('is_active', true)->orderBy('order')->get();
            $view->with('infografis', $infografis);
        });
    }
}
