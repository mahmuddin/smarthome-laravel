<?php

namespace App\Listeners;

use Stancl\Tenancy\Events\TenantCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateTenantDatabase
{
    public function handle(TenantCreated $event): void
    {
        $databaseName = 'smarthome_tenant_' . preg_replace('/[^a-zA-Z0-9_]/', '', $event->tenant->id);

        // 1. Create the tenant's database
        DB::statement("CREATE DATABASE \"$databaseName\"");

        // 2. Set tenant database config dynamically (optional if you're using auto DB management)
        config([
            'database.connections.tenant.database' => $databaseName,
        ]);

        // 3. Run tenant migrations
        Artisan::call('tenants:migrate', [
            '--tenants' => [$event->tenant->id],
            '--force' => true,
        ]);
    }
}
