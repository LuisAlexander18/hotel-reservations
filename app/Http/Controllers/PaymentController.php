<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Customer;
use App\Models\InventoryAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function create()
    {
        $rooms = Room::where('status', 'occupied')->get();
        return view('admin.payments.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        // Eliminar el campo 'card_type' del request si el método de pago es 'cash' antes de la validación
        if ($request->payment_method == 'cash') {
            $request->request->remove('card_type');
        }

        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'payment_method' => 'required|in:cash,card',
            'card_type' => 'required_if:payment_method,card|in:Mastercard,Visa,DinnersClub',
            'received_amount' => 'required|numeric|min:0'
        ]);

        $room = Room::findOrFail($validatedData['room_id']);
        $reservation = $room->reservations()->where('status', 'confirmed')->firstOrFail();
        $customer = $reservation->customer;

        $check_in_date = Carbon::parse($reservation->check_in_date);
        $check_out_date = Carbon::parse($reservation->check_out_date);
        $days = $check_in_date->diffInDays($check_out_date) + 1;

        $room_cost = $room->price * $days;

        // Obtener productos adicionales
        $inventoryAssignments = InventoryAssignment::where('assignable_type', Room::class)
            ->where('assignable_id', $room->id)
            ->get();

        $additional_cost = $inventoryAssignments->sum(function ($assignment) {
            return $assignment->quantity * $assignment->inventory->price;
        });

        $subtotal = $room_cost + $additional_cost;
        $tax_percentage = config('app.tax_percentage', 15);
        $tax_amount = $subtotal * ($tax_percentage / 100);
        $total_amount = $subtotal + $tax_amount;

        // Asegurarse de que el campo `received_amount` tenga el valor correcto
        $received_amount = $total_amount;
        $validatedData['received_amount'] = $received_amount;

        if ($validatedData['payment_method'] == 'cash' && $validatedData['received_amount'] < $total_amount) {
            return redirect()->back()->with('error', 'El valor recibido es menor al total a pagar.');
        }

        $payment = new Payment();
        $payment->room_id = $room->id;
        $payment->customer_id = $customer->id;
        $payment->user_id = Auth::id();
        $payment->reservation_id = $reservation->id;
        $payment->subtotal = $subtotal;
        $payment->tax_percentage = $tax_percentage;
        $payment->tax_amount = $tax_amount;
        $payment->total_amount = $total_amount;
        $payment->payment_method = $validatedData['payment_method'];
        $payment->card_type = $validatedData['payment_method'] == 'card' ? $validatedData['card_type'] : null;
        $payment->payment_date = now();
        $payment->status = 'completed';

        if ($payment->save()) {
            // Cambiar el estado de la habitación a 'available'
            $room->status = 'available';
            $room->save();

            // Actualizar el estado de la reserva a 'cancelled' y limpiar las fechas y el cliente
            $reservation->status = 'cancelled';
            $reservation->check_in_date = '2000-01-01'; // Fecha ficticia por defecto
            $reservation->check_out_date = '2000-01-02'; // Fecha ficticia por defecto
            $reservation->customer_id = null; // ID del cliente por defecto o null
            $reservation->save();

            return redirect()->route('payments.create')->with('success', 'Pago confirmado y habitación liberada.');
        }

        return redirect()->route('payments.create')->with('error', 'Error al procesar el pago. Inténtelo de nuevo.');
    }

    public function getRoomDetails(Room $room)
    {
        $reservation = $room->reservations()->where('status', 'confirmed')->firstOrFail();
        $customer = $reservation->customer;

        $check_in_date = Carbon::parse($reservation->check_in_date);
        $check_out_date = Carbon::parse($reservation->check_out_date);
        $days = $check_in_date->diffInDays($check_out_date) + 1;

        $room_cost = $room->price * $days;

        // Obtener productos adicionales
        $inventoryAssignments = InventoryAssignment::where('assignable_type', Room::class)
            ->where('assignable_id', $room->id)
            ->get();

        $additional_cost = $inventoryAssignments->sum(function ($assignment) {
            return $assignment->quantity * $assignment->inventory->price;
        });

        $subtotal = $room_cost + $additional_cost;
        $tax_percentage = config('app.tax_percentage', 15);
        $tax_amount = $subtotal * ($tax_percentage / 100);
        $total_amount = $subtotal + $tax_amount;

        return response()->json([
            'customer' => $customer,
            'room' => $room,
            'check_in_date' => $check_in_date->format('Y-m-d'),
            'check_out_date' => $check_out_date->format('Y-m-d'),
            'days_reserved' => $days,
            'room_cost' => $room_cost,
            'additional_cost' => $additional_cost,
            'subtotal' => $subtotal,
            'tax_percentage' => $tax_percentage,
            'tax_amount' => $tax_amount,
            'total_amount' => $total_amount,
            'inventoryAssignments' => $inventoryAssignments->map(function ($assignment) {
                return [
                    'inventory_name' => $assignment->inventory->name,
                    'quantity' => $assignment->quantity,
                    'price' => (float) $assignment->inventory->price,
                    'total' => $assignment->quantity * (float) $assignment->inventory->price,
                ];
            }),
        ]);
    }
}
