<?php
namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\AutomationRule;
use Illuminate\Http\Request;

class AutomationRuleController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'automation_id' => 'required|exists:automations,id',
            'device_id'     => 'required|exists:devices,id',
            'condition'     => 'required|string', // e.g. >, <, ==
            'value'         => 'required|string',
        ]);

        $rule = AutomationRule::create($data);
        return response()->json($rule, 201);
    }

    public function update(Request $request, AutomationRule $automationRule)
    {
        $data = $request->validate([
            'condition' => 'sometimes|required|string',
            'value'     => 'sometimes|required|string',
        ]);

        $automationRule->update($data);
        return response()->json($automationRule);
    }

    public function destroy(AutomationRule $automationRule)
    {
        $automationRule->delete();
        return response()->json(['message' => 'Rule deleted']);
    }
}
