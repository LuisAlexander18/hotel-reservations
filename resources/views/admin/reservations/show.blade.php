@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Reservation Details</h4>
                </div>
                <div class="card-body">
                    <p><strong>Room:</strong> {{ $reservation->room->name }}</p>
                    <p><strong>Customer:</strong> {{ $reservation->customer->name }}</p>
                    <p><strong>Check-in Date:</strong> {{ $reservation->checkin_date }}</p>
                    <p><strong>Check-out Date:</strong> {{ $reservation->checkout_date }}</p>
                    <p><strong>Status:</strong> {{ $reservation->status }}</p>
                    <p><strong>Notes:</strong> {{ $reservation->notes }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
