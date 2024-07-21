@extends('layouts.template-user')

@section('contenido')
<div class="container">
    <h1>Reporte de Reservaciones</h1><br>
    <div class="mb-3">
        <a href="{{ route('admin.reports.reservations', ['format' => 'excel']) }}" class="btn btn-success">Exportar a Excel</a>
        <a href="{{ route('admin.reports.reservations', ['format' => 'pdf']) }}" class="btn btn-danger">Exportar a PDF</a>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.reports.reservations') }}">
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="user" class="form-label">Usuario</label>
                <input type="text" name="user" id="user" class="form-control" value="{{ request('user') }}">
            </div>
            <div class="col-md-3">
                <label for="room" class="form-label">Habitación</label>
                <input type="text" name="room" id="room" class="form-control" value="{{ request('room') }}">
            </div>
            <div class="col-md-3">
                <label for="customer" class="form-label">Cliente</label>
                <input type="text" name="customer" id="customer" class="form-control" value="{{ request('customer') }}">
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label">Estado</label>
                <select name="status" id="status" class="form-control">
                    <option value="">Todos</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendiente</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmado</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                </select>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="check_in_date" class="form-label">Fecha de Check-in</label>
                <input type="date" name="check_in_date" id="check_in_date" class="form-control" value="{{ request('check_in_date') }}">
            </div>
            <div class="col-md-3">
                <label for="check_out_date" class="form-label">Fecha de Check-out</label>
                <input type="date" name="check_out_date" id="check_out_date" class="form-control" value="{{ request('check_out_date') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Habitación</th>
                <th>Cliente</th>
                <th>Fecha de Check-in</th>
                <th>Fecha de Check-out</th>
                <th>Estado</th>
                <th>Creado en</th>
                <th>Actualizado en</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
            <tr>
                <td>{{ $reservation->id }}</td>
                <td>{{ $reservation->user->name ?? 'N/A' }}</td>
                <td>{{ $reservation->room->name ?? 'N/A' }}</td>
                <td>{{ $reservation->customer->name ?? 'N/A' }}</td>
                <td>{{ $reservation->check_in_date }}</td>
                <td>{{ $reservation->check_out_date }}</td>
                <td>{{ $reservation->status }}</td>
                <td>{{ $reservation->created_at }}</td>
                <td>{{ $reservation->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $reservations->links() }}
    </div>
</div>
@endsection
