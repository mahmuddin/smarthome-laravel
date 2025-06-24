<?php
namespace App\Multitenancy\Tasks\SwitchTenantDatabaseTask;

use App\Models\Tenant;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Spatie\Multitenancy\Contracts\IsTenant;
use Spatie\Multitenancy\Tasks\SwitchTenantDatabaseTask;

class TenantDatabaseManager extends SwitchTenantDatabaseTask
{
    public function makeCurrent(IsTenant $tenant): void
    {
        if (! $tenant instanceof Tenant) {
            throw new \InvalidArgumentException('The tenant must be an instance of App\Models\Tenant');
        }

        Config::set('database.connections.tenant', [
            'driver'   => 'pgsql',
            'host'     => env('DB_HOST', '127.0.0.1'),
            'port'     => env('DB_PORT', '5432'),
            'database' => $tenant->database,
            'username' => env('DB_USERNAME', 'postgres'),
            'password' => env('DB_PASSWORD', ''),
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
        ]);

        Config::set('database.default', 'tenant');

        // Optional: Bersihkan koneksi cache lama
        DB::purge('tenant');
    }

    public function forgetCurrent(): void
    {
        Config::set('database.default', config('multitenancy.landlord_database_connection_name'));

        // Optional: Bersihkan koneksi tenant
        DB::purge('tenant');
    }
}
