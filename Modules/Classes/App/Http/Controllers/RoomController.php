<?php

namespace Modules\Classes\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Classes\App\Models\Room;
use Modules\Classes\App\Models\ClassModel;
use Modules\Classes\App\Http\Requests\StoreRoomRequest;
use Modules\Classes\App\Http\Requests\UpdateRoomRequest;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return Room::with('class')->get();
    }

    public function store(StoreRoomRequest $request)
    {
        Room::create($request->validated());
        return response()->json(['message' => 'Room added successfully']);
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->update($request->validated());
        return response()->json(['message' => 'Room updated successfully']);
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json(['message' => 'Room deleted successfully']);
    }
}
