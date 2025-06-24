<?php
namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return Home::with('rooms.devices')->where('user_id', auth()->id())->get();
    }

    public function show($id)
    {
        return Home::with('rooms.devices')->where('user_id', auth()->id())->findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string',
            'address' => 'nullable|string',
        ]);

        return Auth::guard('tenant-api')->user()->homes()->create($data);
    }
}
