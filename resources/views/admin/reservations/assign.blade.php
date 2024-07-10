<!-- resources/views/admin/reservations/assign.blade.php -->

@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Asignar Habitación a {{ $customer->name }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('reservations.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                        <div class="mb-3">
                            <label for="room_id" class="form-label">Habitación</label>
                            <select name="room_id" id="room_id" class="form-control" required>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->room_number }} - {{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="check_in_date" class="form-label">Fecha de Check-in</label>
                            <input type="date" class="form-control" id="check_in_date" name="check_in_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="check_out_date" class="form-label">Fecha de Check-out</label>
                            <input type="date" class="form-control" id="check_out_date" name="check_out_date" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Asignar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
