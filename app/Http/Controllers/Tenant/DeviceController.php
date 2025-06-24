<?php
namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function updateStatus(Request $request, Device $device)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $device->update(['status' => $request->status]);

        return response()->json(['message' => 'Status updated']);
    }

    public function log(Request $request, Device $device)
    {
        $request->validate(['value' => 'required|string']);

        $device->logs()->create([
            'value'       => $request->value,
            'recorded_at' => now(),
        ]);

        return response()->json(['message' => 'Log recorded']);
    }
}
