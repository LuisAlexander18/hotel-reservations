<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'room_number' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('room_images', 'public');
        }

        Room::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'capacity' => $request->capacity,
            'room_number' => $request->room_number,
            'type' => $request->type ?? 'standard',
            'image' => $imagePath,
        ]);

        return redirect()->route('rooms.index')->with('success', 'Habitación creada exitosamente.');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'room_number' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $room->image;
        if ($request->hasFile('image')) {
            if ($room->image) {
                Storage::delete('public/' . $room->image);
            }
            $imagePath = $request->file('image')->store('room_images', 'public');
        }

        $room->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'capacity' => $request->capacity,
            'room_number' => $request->room_number,
            'type' => $request->type ?? 'standard',
            'image' => $imagePath,
        ]);

        return redirect()->route('rooms.index')->with('success', 'Habitación actualizada exitosamente.');
    }

    public function destroy(Room $room)
    {
        if ($room->image) {
            Storage::delete('public/' . $room->image);
        }
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Habitación eliminada exitosamente.');
    }
}
