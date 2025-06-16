<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Unntuk route API
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->app->getNamespace() . 'Http\Controllers')
            ->group(base_path('routes/api.php'));
        // Unntuk route web
        Route::middleware('web')
            ->namespace($this->app->getNamespace() . 'Http\Controllers')
            ->group(base_path('routes/web.php'));
    }
}
