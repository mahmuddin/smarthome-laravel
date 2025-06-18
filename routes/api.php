<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Tenant\TenantController;
use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'force-json'])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']); // Untuk ada tenant baru yang mau register (bukan di register oleh super admin)
});

Route::middleware(['auth:api', 'force-json'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', function () {
        return response()->json([
            'access_token' => auth()->refresh(),
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
        ]);
    });

    Route::post('/tenant', [TenantController::class, 'create']);
});
