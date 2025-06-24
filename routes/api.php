<?php

use App\Http\Controllers\SuperAdmin\AuthController;
use App\Http\Controllers\SuperAdmin\TenantController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\Tenant\AuthController as TenantAuthController;
use App\Http\Controllers\Tenant\AutomationController;
use App\Http\Controllers\Tenant\AutomationRuleController;
use App\Http\Controllers\Tenant\DeviceController;
use App\Http\Controllers\Tenant\HomeController;
use App\Http\Controllers\Tenant\RoomController;
use App\Http\Controllers\Tenant\ScheduleController;
use App\Http\Controllers\Tenant\UserController as TenantUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Di sini kamu bisa mendefinisikan semua route untuk API, baik untuk
| tenant (tenant-aware) maupun non-tenant (central).
|
*/

// Super admin login (no tenant context)
// ✅ Menggunakan middleware 'auth:api' untuk otentikasi super admin
// ✅ Menggunakan prefix 'superadmin' untuk mengelompokkan route super admin
// ✅ Menggunakan nama route 'api.superadmin.*' untuk konsistensi
// ✅ Menggunakan controller SuperAdmin\AuthController untuk login, logout, dan me
// ✅ Menggunakan controller SuperAdmin\UserController untuk manajemen user
// ✅ Menggunakan controller SuperAdmin\TenantController untuk manajemen tenant
Route::prefix('superadmin')->name('api.')->group(function () {
    // ✅ Tanpa auth middleware
    Route::post('/login', [AuthController::class, 'login'])->name('superadmin.login');

    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('superadmin.logout');
        Route::get('/me', [AuthController::class, 'me'])->name('superadmin.me');

        // User Management
        Route::prefix('users')->group(callback: function () {
            // Hanya superadmin yang bisa create, update, delete
            Route::middleware('role:superadmin')->group(function () {
                Route::post('/', [UserController::class, 'store'])->name('superadmin.users.store');
                Route::put('/{id}', [UserController::class, 'update'])->name('superadmin.users.update');
                Route::delete('/{id}', [UserController::class, 'destroy'])->name('superadmin.users.destroy');
            });

            // admin & superadmin bisa index dan show
            Route::middleware('role:admin,superadmin')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('superadmin.users.index');
                Route::get('/{id}', [UserController::class, 'show'])->name('superadmin.users.show');
            });
        });

        // Management Tenant
        Route::prefix('tenants')->group(function () {
            Route::get('/', [TenantController::class, 'index'])->name('superadmin.tenants.index');
            Route::post('/', [TenantController::class, 'store'])->name('superadmin.tenants.store');
            Route::get('/{id}', [TenantController::class, 'show'])->name('superadmin.tenants.show');
            Route::put('/{id}', [TenantController::class, 'update'])->name('superadmin.tenants.update');
            Route::delete('/{id}', [TenantController::class, 'destroy'])->name('superadmin.tenants.destroy');
        });
    });
});

// Route tenant-aware (tenant context)
// ✅ Menggunakan middleware 'tenant' untuk memastikan konteks tenant
// ✅ Menggunakan middleware 'auth:tenant-api' untuk otentikasi tenant
// ✅ Menggunakan prefix 'tenant' untuk mengelompokkan route tenant
// ✅ Menggunakan nama route 'api.tenant.*' untuk konsistensi
// ✅ Menggunakan controller Tenant\AuthController untuk login, logout, dan me
// ✅ Menggunakan controller Tenant\UserController untuk manajemen user tenant
Route::middleware('tenant')->name('api.')->group(function () {
    // ✅ Login Tenant
    Route::post('/login', [TenantAuthController::class, 'login'])->name('tenant.login');

    Route::middleware('auth:tenant-api')->group(function () {
        Route::post('/logout', [TenantAuthController::class, 'logout'])->name('tenant.logout');
        Route::get('/me', [TenantAuthController::class, 'me'])->name('tenant.me');

        // Contoh route tenant-aware untuk user management
        Route::prefix('users')->group(function () {
            Route::get('/', [TenantUserController::class, 'index'])->name('tenant.users.index');
            Route::post('/', [TenantUserController::class, 'store'])->name('tenant.users.store');
            Route::get('/{id}', [TenantUserController::class, 'show'])->name('tenant.users.show');
            Route::put('/{id}', [TenantUserController::class, 'update'])->name('tenant.users.update');
            Route::delete('/{id}', [TenantUserController::class, 'destroy'])->name('tenant.users.destroy');
        });

        // Grouping untuk homes
        Route::prefix('homes')->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('tenant.homes.index');
            Route::get('/{id}', [HomeController::class, 'show'])->name('tenant.homes.show');
            Route::post('/', [HomeController::class, 'store'])->name('tenant.homes.store');
        });

        // Grouping untuk devices
        Route::prefix('devices')->group(function () {
            Route::post('{device}/status', [DeviceController::class, 'updateStatus'])->name('tenant.devices.updateStatus');
            Route::post('{device}/log', [DeviceController::class, 'log'])->name('tenant.devices.log');
        });

        Route::apiResource('rooms', RoomController::class);

        Route::apiResource('automations', AutomationController::class)->except(['edit', 'create']);

        Route::prefix('automation-rules')->group(function () {
            Route::post('/', [AutomationRuleController::class, 'store'])->name('tenant.automationRules.store');
            Route::put('/{automationRule}', [AutomationRuleController::class, 'update'])->name('tenant.automationRules.update');
            Route::delete('/{automationRule}', [AutomationRuleController::class, 'destroy'])->name('tenant.automationRules.destroy');
        });

        Route::apiResource('schedules', ScheduleController::class)->except(['show']);

    });
});
