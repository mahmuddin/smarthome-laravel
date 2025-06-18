<?php
namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Stancl\Tenancy\Contracts\TenantResolver;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        // Paksa semua request API untuk menganggap ingin JSON
        Request::macro('wantsJson', function () {
            return true;
        });
    }
}
