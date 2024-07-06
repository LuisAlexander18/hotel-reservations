@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Reserva</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('reservations.update', $reservation) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="room_id">Habitación</label>
                            <select name="room_id" class="form-control" required>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ $room->id == $reservation->room_id ? 'selected' : '' }}>
                                        {{ $room->room_number }} - {{ $room->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="customer_id">Cliente</label>
                            <select name="customer_id" class="form-control" required>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ $customer->id == $reservation->customer_id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="checkin_date">Fecha de Check-in</label>
                            <input type="date" name="checkin_date" class="form-control" value="{{ $reservation->checkin_date }}" required>
                        </div>
                        <div class="form-group">
                            <label for="checkout_date">Fecha de Check-out</label>
                            <input type="date" name="checkout_date" class="form-control" value="{{ $reservation->checkout_date }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Actualizar Reserva</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
