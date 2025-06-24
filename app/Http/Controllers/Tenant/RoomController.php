<?php
namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        return Room::with('devices')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'home_id' => 'required|exists:homes,id',
            'name'    => 'required|string',
        ]);

        $room = Room::create($data);
        return response()->json($room, 201);
    }

    public function show(Room $room)
    {
        return $room->load('devices');
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $room->update($data);
        return response()->json($room);
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json(['message' => 'Room deleted']);
    }
}
