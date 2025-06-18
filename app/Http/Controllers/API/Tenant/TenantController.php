<?php

namespace App\Http\Controllers\API\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenantRequest;
use App\Services\TenantService;
use Illuminate\Http\JsonResponse;

class TenantController extends Controller
{
    protected TenantService $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function create(TenantRequest $request): JsonResponse
    {
        try {
            $tenant = $this->tenantService->createTenant($request->validated());

            return response()->json([
                'message' => 'Tenant created, migrated, and seeded successfully',
                'tenant'  => $tenant,
                'domain'  => null, // ubah jika perlu ambil domain
            ], 201);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error creating tenant',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
