<?php
namespace App\Services;

use App\Models\Tenant;
use App\Services\TenantDatabaseCreatorService;
use Database\Seeders\TenantDatabaseSeeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class TenantService
{
    protected TenantDatabaseCreatorService $dbCreator;

    public function __construct(TenantDatabaseCreatorService $dbCreator)
    {
        $this->dbCreator = $dbCreator;
    }

    public function createTenant(array $data): Tenant
    {
        // Generate nama database tenant
        $tenantKey    = strtolower(str_replace('-', '', (string) Str::uuid()));
        $databaseName = 'smarthome_tenant_' . $tenantKey;

        // Buat tenant terlebih dahulu TANPA TRANSAKSI
        $tenant = Tenant::create([
            'id'   => $tenantKey,
            'data' => [], // aman dari null violation
        ]);

// ✅ Simpan data tenant via Stancl
        $tenant->data = [
            'name'     => $data['name'],
            'email'    => $data['email'],
            'role'     => $data['role'],
            'database' => $databaseName,
        ];
        $tenant->save();

        dd($tenant->toArray());

        // Buat domain jika ada
        if (! empty($data['domain'])) {
            $domain = parse_url($data['domain'], PHP_URL_HOST) ?? $data['domain'];
            $tenant->domains()->create([
                'domain' => $domain,
            ]);
        }

        // Buat database tenant DI LUAR TRANSAKSI
        try {
            $this->dbCreator->createDatabase($tenant);
        } catch (\Throwable $e) {
            $tenant->delete(); // Rollback tenant jika gagal buat DB
            throw $e;
        }

        // Barulah lakukan migrasi dan seeding DI DALAM KONTEKS TENANT
        try {
            $tenant->run(function () use ($data) {
                Artisan::call('migrate', [
                    '--path'  => 'database/migrations/tenant',
                    '--force' => true,
                ]);

                app()->makeWith(TenantDatabaseSeeder::class, [
                    'data' => [
                        'name'     => $data['name'] ?? 'Admin',
                        'email'    => $data['email'] ?? 'admin@tenant.com',
                        'password' => $data['password'] ?? 'password',
                        'role'     => $data['role'] ?? 'admin',
                    ],
                ])->run();
            });

            return $tenant;
        } catch (\Throwable $e) {
            // Rollback manual: hapus database & tenant
            $this->dbCreator->dropDatabase($databaseName);
            // Bersihkan jika migrasi/seeding gagal
            $tenant->delete();
            throw $e;
        }
    }
}
