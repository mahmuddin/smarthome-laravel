<?php
namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return Schedule::with('device')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'device_id'     => 'required|exists:devices,id',
            'action'        => 'required|string', // turn_on, turn_off
            'schedule_time' => 'required|date_format:H:i',
            'repeat'        => 'in:once,daily,weekly',
        ]);

        $schedule = Schedule::create($data);
        return response()->json($schedule, 201);
    }

    public function update(Request $request, Schedule $schedule)
    {
        $data = $request->validate([
            'action'        => 'sometimes|required|string',
            'schedule_time' => 'sometimes|required|date_format:H:i',
            'repeat'        => 'in:once,daily,weekly',
        ]);

        $schedule->update($data);
        return response()->json($schedule);
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return response()->json(['message' => 'Schedule deleted']);
    }
}
