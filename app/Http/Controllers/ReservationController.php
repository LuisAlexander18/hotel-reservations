<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use App\Models\Customer;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $rooms = Room::with(['currentReservation'])->orderBy('room_number', 'asc')->get();
        $customers = Customer::all();
        return view('admin.reservations.index', compact('rooms', 'customers'));
    }

    public function changeStatus(Request $request, Room $room)
    {
        $request->validate([
            'status' => 'required|string|in:available,occupied,maintenance',
            'check_in_date' => 'required_if:status,occupied|date|before:check_out_date',
            'check_out_date' => 'required_if:status,occupied|date|after:check_in_date',
            'customer_id' => 'required_if:status,occupied|exists:customers,id'
        ]);

        // Actualizar el estado de la habitación
        $room->status = $request->input('status');
        $room->save();

        if ($room->status == 'occupied') {
            // Crear una nueva reserva
            Reservation::create([
                'room_id' => $room->id,
                'customer_id' => $request->input('customer_id'),
                'check_in_date' => $request->input('check_in_date'),
                'check_out_date' => $request->input('check_out_date'),
                'status' => 'confirmed',
                'user_id' => auth()->user()->id
            ]);
        } elseif ($room->status == 'available') {
            // Eliminar cualquier reserva existente si la habitación se marca como disponible
            Reservation::where('room_id', $room->id)->delete();
        }

        return redirect()->route('reservations.index')->with('success', 'Estado de la habitación actualizado.');
    }

    public function edit(Reservation $reservation)
    {
        $rooms = Room::all();
        $customers = Customer::all();
        return view('admin.reservations.edit', compact('reservation', 'rooms', 'customers'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'customer_id' => 'required_if:status,occupied|exists:customers,id',
            'check_in_date' => 'required|date|before:check_out_date',
            'check_out_date' => 'required|date|after:check_in_date'
        ]);

        $reservation->update([
            'room_id' => $request->input('room_id'),
            'customer_id' => $request->input('customer_id'),
            'check_in_date' => $request->input('check_in_date'),
            'check_out_date' => $request->input('check_out_date'),
            'status' => $request->input('status')
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reserva actualizada exitosamente.');
    }

    public function assignRoom($customer_id)
    {
        $customer = Customer::find($customer_id);
        $rooms = Room::where('status', 'available')->get();
        return view('admin.reservations.assign', compact('customer', 'rooms'));
    }

    public function storeAssignment(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|before:check_out_date',
            'check_out_date' => 'required|date|after:check_in_date'
        ]);

        $room = Room::find($request->input('room_id'));
        $room->status = 'occupied';
        $room->save();

        Reservation::create([
            'room_id' => $room->id,
            'customer_id' => $request->input('customer_id'),
            'check_in_date' => $request->input('check_in_date'),
            'check_out_date' => $request->input('check_out_date'),
            'status' => 'confirmed',
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('reservations.index')->with('success', 'Habitación asignada exitosamente.');
    }
}
