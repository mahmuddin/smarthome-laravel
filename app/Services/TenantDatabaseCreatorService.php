<?php
namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Stancl\Tenancy\Contracts\Tenant;

class TenantDatabaseCreatorService
{
    public function createDatabase(Tenant $tenant): void
    {
        // // Buat nama database secara konsisten
        // $dbName = 'smarthome_tenant_' . strtolower(str_replace('-', '', $tenant->getTenantKey()));

        // // Jalankan query CREATE DATABASE
        // DB::statement("CREATE DATABASE \"$dbName\"");

        // // Optional: bisa daftarkan runtime connection jika perlu
        // config(['database.connections.tenant.database' => $dbName]);

        // 3. Run tenant migrations
        Artisan::call('tenants:migrate', [
            '--tenants' => [$tenant->id],
            '--force'   => true,
        ]);
    }

    public function dropDatabase(string $dbName): void
    {
        DB::statement("DROP DATABASE IF EXISTS \"$dbName\"");
    }
}
