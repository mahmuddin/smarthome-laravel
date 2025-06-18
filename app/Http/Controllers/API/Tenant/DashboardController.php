<?php

namespace App\Http\Controllers\API\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    /**
     * Display the dashboard for the current tenant.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Cek apakah tenant sudah diinisialisasi
        if (!tenant()) {
            return response()->json([
                'message' => 'Tenant not initialized. Are you accessing from the correct domain?',
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'tenant_id' => tenant('id'),
            'tenant_data' => tenant()->data ?? null,
            'message' => 'Welcome to SmartHome tenant dashboard!',
        ]);
    }
}
