<?php
namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\AutomationStoreRequest;
use App\Http\Requests\AutomationUpdateRequest;
use App\Models\Tenant\Automation;
use App\Services\AutomationService;

class AutomationController extends Controller
{
    protected AutomationService $service;

    public function __construct(AutomationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json(Automation::all());
    }

    public function show($id)
    {
        $data = Automation::findOrFail($id);
        return response()->json($data);
    }

    public function store(AutomationStoreRequest $request)
    {
        $data = $this->service->create($request->validated());
        return response()->json($data, 201);
    }

    public function update(AutomationUpdateRequest $request, $id)
    {
        $data = Automation::findOrFail($id);
        $data = $this->service->update($data, $request->validated());
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = Automation::findOrFail($id);
        $data->delete(); // Soft delete
        return response()->json(['message' => 'Automation soft deleted']);
    }
}
