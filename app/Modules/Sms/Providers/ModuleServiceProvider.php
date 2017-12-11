<?php

namespace App\Modules\Sms\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'sms');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'sms');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'sms');
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
