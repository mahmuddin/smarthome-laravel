<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Tenant\DashboardController;
use App\Http\Controllers\API\Tenant\DeviceController;
use App\Http\Controllers\API\Tenant\RoomController;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'auth:api',
    InitializeTenancyByPath::class,
])->group(function () {
    Route::prefix('{tenant}/api')
        ->group(function () {
            // Dashboard
            Route::get('/dashboard', [DashboardController::class, 'index']);

            // Devices
            Route::prefix('devices')->group(function () {
                Route::get('/', [DeviceController::class, 'index']);
                Route::post('/', [DeviceController::class, 'store']);
                Route::get('/{id}', [DeviceController::class, 'show']);
                Route::put('/{id}', [DeviceController::class, 'update']);
                Route::delete('/{id}', [DeviceController::class, 'destroy']);
            });

            // Rooms
            Route::prefix('rooms')->group(function () {
                Route::get('/', [RoomController::class, 'index']);
                Route::post('/', [RoomController::class, 'store']);
                Route::get('/{id}', [RoomController::class, 'show']);
                Route::put('/{id}', [RoomController::class, 'update']);
                Route::delete('/{id}', [RoomController::class, 'destroy']);
            });
        });
});


