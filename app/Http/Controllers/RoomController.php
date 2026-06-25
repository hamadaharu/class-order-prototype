<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();
        
        $validated = $request->validate([
            'code' => 'required|string|unique:rooms',
            'name' => 'required|string|max:255',
            'location' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        if (isset($validated['facilities']) && is_string($validated['facilities'])) {
            $validated['facilities'] = array_map('trim', explode(',', $validated['facilities']));
        }

        $validated['is_active'] = $request->has('is_active');

        Room::create($validated);
        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        $this->authorizeAdmin();
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $this->authorizeAdmin();
        
        $validated = $request->validate([
            'code' => 'required|string|unique:rooms,code,' . $room->id,
            'name' => 'required|string|max:255',
            'location' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        if (isset($validated['facilities']) && is_string($validated['facilities'])) {
            $validated['facilities'] = array_map('trim', explode(',', $validated['facilities']));
        }

        $validated['is_active'] = $request->has('is_active');

        $room->update($validated);
        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $this->authorizeAdmin();
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
    
    private function authorizeAdmin()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }
    }
}
