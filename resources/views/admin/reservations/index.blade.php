@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Reservations</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Room</th>
                                <th>Customer</th>
                                <th>Check-in Date</th>
                                <th>Check-out Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->room->name }}</td>
                                <td>{{ $reservation->customer->name }}</td>
                                <td>{{ $reservation->checkin_date }}</td>
                                <td>{{ $reservation->checkout_date }}</td>
                                <td>{{ $reservation->status }}</td>
                                <td>
                                    <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-info">View</a>
                                    <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
