<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Customer;
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
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'payment_method' => 'required|in:cash,card',
            'card_type' => 'nullable|required_if:payment_method,card|in:Mastercard,Visa,DinnersClub',
        ]);

        $room = Room::findOrFail($request->room_id);
        $reservation = $room->reservations()->where('status', 'confirmed')->firstOrFail();
        $customer = $reservation->customer;

        $check_in_date = Carbon::parse($reservation->check_in_date);
        $check_out_date = Carbon::parse($reservation->check_out_date);
        $days = $check_in_date->diffInDays($check_out_date);

        $subtotal = $room->price * $days;
        $tax_percentage = config('app.tax_percentage', 15);
        $tax_amount = $subtotal * ($tax_percentage / 100);
        $total_amount = $subtotal + $tax_amount;

        $payment = new Payment();
        $payment->room_id = $room->id;
        $payment->customer_id = $customer->id;
        $payment->user_id = Auth::id();
        $payment->reservation_id = $reservation->id;
        $payment->subtotal = $subtotal;
        $payment->tax_percentage = $tax_percentage;
        $payment->tax_amount = $tax_amount;
        $payment->total_amount = $total_amount;
        $payment->payment_method = $request->payment_method;
        $payment->card_type = $request->payment_method == 'card' ? $request->card_type : null;
        $payment->payment_date = now();
        $payment->status = 'completed';

        if ($payment->save()) {
            // Cambiar el estado de la habitación a 'available'
            $room->status = 'available';
            $room->save();

            return redirect()->route('payments.create')->with('success', 'Pago confirmado y habitación liberada.');
        }

        return redirect()->route('payments.create')->with('error', 'Error al procesar el pago. Inténtelo de nuevo.');
    }
}
