<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $rooms = Room::with('reservations')->orderBy('room_number', 'asc')->get();
        return view('admin.reservations.index', compact('rooms'));
    }

    public function changeStatus(Request $request, Room $room)
    {
        $request->validate([
            'status' => 'required|string|in:available,occupied,maintenance',
            'check_in_date' => 'required|date|before:check_out_date',
            'check_out_date' => 'required|date|after:check_in_date'
        ]);

        $room->status = $request->input('status');
        $room->save();

        if ($room->status == 'occupied') {
            Reservation::create([
                'room_id' => $room->id,
                'user_id' => auth()->user()->id,
                'check_in_date' => $request->input('check_in_date'),
                'check_out_date' => $request->input('check_out_date'),
                'status' => 'confirmed'
            ]);
        }

        return redirect()->route('reservations.index')->with('success', 'Estado de la habitación actualizado.');
    }
}
