<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

class TenantRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Route::middleware([
            'web',
            InitializeTenancyByPath::class,
            PreventAccessFromCentralDomains::class,
        ])
        ->prefix(prefix: '{tenant}/api') // <- prefix path tenant. Bisa diubah sesuai kebutuhan.
        ->group(base_path('routes/tenant.php'));
    }
}
