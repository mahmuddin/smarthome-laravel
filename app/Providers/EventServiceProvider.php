<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
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
        //
    }

    protected $listen = [
        \Stancl\Tenancy\Events\TenantCreated::class => [
            // \App\Listeners\CreateTenantDatabase::class,
        ],
    ];
}
