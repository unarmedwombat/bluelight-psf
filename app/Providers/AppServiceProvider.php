<?php

namespace App\Providers;

use Filament\Facades\Filament;
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
        Filament::serving(function (): void {
            Filament::registerTheme(mix('css/app.css'));
        });
        Filament::registerNavigationGroups([
            'Frameworks',
            'Contractors',
            'Settings',
        ]);
    }
}
