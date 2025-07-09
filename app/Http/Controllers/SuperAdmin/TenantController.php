<?php
namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Tenant\TenantUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // pastikan ini disertakan di atas
use Illuminate\Support\Str;

class TenantController extends Controller
{
    public function index()
    {
        // Ambil semua tenant yang ada
        $tenants = Tenant::with('domains')->get();

        return response()->json([
            'message' => '✅ List of tenants',
            'tenants' => $tenants,
        ]);
    }
    // Buat tenant baru
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'name'     => 'required|string|unique:tenants,name',
                'slug'     => 'nullable|string|unique:tenants,slug',
                'database' => 'required|string|unique:tenants,database',
                'email'    => 'required|email',
                'data'     => 'nullable|array',
                'domain'   => 'nullable|string|unique:domains,domain',
            ]);

            $tenant = Tenant::create([
                'name'     => $validated['name'],
                'slug'     => $validated['slug'] ?? Str::slug($validated['name']),
                'database' => $validated['database'],
                'email'    => $validated['email'] ?? null,
                'data'     => $validated['data'] ?? [],
            ]);

            // Tambahkan domain jika diberikan
            if (! empty($validated['domain'])) {
                $tenant->domains()->create([
                    'domain' => parse_url($validated['domain'], PHP_URL_HOST) ?? $validated['domain'],
                ]);
            }

            // 🛠 Buat database fisik (MySQL/MariaDB)
            $databaseName = $tenant->database;

            // Cek apakah database sudah ada
            $databaseExists = DB::connection('landlord')->select("SELECT 1 FROM pg_database WHERE datname = ?", [$databaseName]);

            if (empty($databaseExists)) {
                // Baru buat database jika belum ada
                DB::connection('landlord')->statement("CREATE DATABASE \"$databaseName\"");
            }

            // 🎯 Set context ke tenant dan jalankan migrasi
            $tenant->makeCurrent();

            logger('Current tenant DB: ' . DB::connection()->getDatabaseName());

            logger('Running migration for tenant ' . $tenant->id);

            Artisan::call('tenants:artisan', [
                'artisanCommand' => 'migrate --force --path=database/migrations/tenant',
                '--tenant'       => [$tenant->id],
            ]);

            logger('Migration result: ' . Artisan::output());

            // ✅ Tambahkan user admin default
            TenantUser::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'role'     => $validated['role'] ?? 'admin', // default role admin
                'password' => Hash::make('secret'),          // ganti dengan password yang lebih aman!
            ]);

            DB::commit();

            return response()->json([
                'message' => '✅ Tenant created successfully',
                'tenant'  => $tenant,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => '❌ Tenant creation failed',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
