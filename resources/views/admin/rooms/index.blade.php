@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Habitaciones</h4>
                    <a href="{{ route('rooms.create') }}" class="btn btn-primary">Añadir Habitación</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Capacidad</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                            <tr>
                                <td>{{ $room->room_number }}</td>
                                <td>{{ $room->name }}</td>
                                <td>{{ $room->description }}</td>
                                <td>{{ $room->price }}</td>
                                <td>{{ $room->capacity }}</td>
                                <td>
                                    @if($room->image)
                                        <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}" width="100">
                                    @else
                                        No image
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('rooms.edit', $room) }}" class="btn btn-warning">Editar</a>
                                    <form action="{{ route('rooms.destroy', $room) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta habitación?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
