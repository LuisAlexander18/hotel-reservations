@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Gestión de Reservas</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Número de Habitación</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                            <tr>
                                <td>{{ $room->room_number }}</td>
                                <td>{{ $room->name }}</td>
                                <td>{{ $room->status }}</td>
                                <td>
                                    <input type="date" name="check_in_date" class="form-control" form="form-{{ $room->id }}" value="{{ $room->currentReservation->check_in_date ?? '' }}" required>
                                </td>
                                <td>
                                    <input type="date" name="check_out_date" class="form-control" form="form-{{ $room->id }}" value="{{ $room->currentReservation->check_out_date ?? '' }}" required>
                                </td>
                                <td>
                                    <form id="form-{{ $room->id }}" action="{{ route('reservations.changeStatus', $room) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" name="status" value="available" class="btn btn-transparent">Disponible</button>
                                        <button type="submit" name="status" value="occupied" class="btn btn-danger">Reservar</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.querySelectorAll('input[name="check_in_date"]').forEach(function(input) {
            input.setAttribute('min', today);
            input.addEventListener('change', function() {
                const checkOutInput = document.querySelector('input[name="check_out_date"][form="'+input.getAttribute('form')+'"]');
                checkOutInput.setAttribute('min', input.value);
            });
        });
    });
</script>
