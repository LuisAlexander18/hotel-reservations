@extends('layouts.template-user')

@section('contenido')
<div class="container">
    <h1>Reporte de Habitaciones</h1><br>
    <div class="mb-3">
        <a href="{{ route('admin.reports.rooms', ['format' => 'excel']) }}" class="btn btn-success">Exportar a Excel</a>
        <a href="{{ route('admin.reports.rooms', ['format' => 'pdf']) }}" class="btn btn-danger">Exportar a PDF</a>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.reports.rooms') }}">
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="room_number" class="form-label">Número de Habitación</label>
                <input type="text" name="room_number" id="room_number" class="form-control" value="{{ request('room_number') }}">
            </div>
            <div class="col-md-3">
                <label for="type" class="form-label">Tipo</label>
                <input type="text" name="type" id="type" class="form-control" value="{{ request('type') }}">
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label">Estado</label>
                <select name="status" id="status" class="form-control">
                    <option value="">Todos</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Disponible</option>
                    <option value="occupied" {{ request('status') == 'occupied' ? 'selected' : '' }}>Ocupada</option>
                    <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>En Mantenimiento</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th># Habitación</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th># de personas</th>
                <th>Creado en</th>
                <th>Actualizado en</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
            <tr>
                <td>{{ $room->room_number }}</td>
                <td>{{ $room->type }}</td>
                <td>{{ $room->price }}</td>
                <td>{{ $room->status }}</td>
                <td>{{ $room->name }}</td>
                <td>{{ $room->description }}</td>
                <td>{{ $room->capacity }}</td>
                <td>{{ $room->created_at }}</td>
                <td>{{ $room->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $rooms->links() }}
    </div>
</div>
@endsection
