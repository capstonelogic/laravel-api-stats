<?php

namespace CapstoneLogic\Stats;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class StatsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ .'/../config/stats.php', 'capstonelogic.stats');
        $this->publishes([__DIR__ .'/../config/stats.php' => config_path('capstonelogic.stats.php')], 'stats-config');
        
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations/');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace('CapstoneLogic\Stats')
            ->group(__DIR__ . '/../routes/api.php');
    }
}
