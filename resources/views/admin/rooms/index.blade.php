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
                                <th>Número de Habitación</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Capacidad</th>
                                <th>Imagen</th>
                                <th>Estado</th>
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
                                <td>{{ $room->status }}</td>
                                <td>
                                    <a href="{{ route('rooms.edit', $room) }}" class="btn btn-warning">Editar</a>
                                    <form action="{{ route('rooms.destroy', $room) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta habitación?');">Eliminar</button>
                                    </form>
                                    @if($room->status == 'Disponible')
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#reserveModal-{{ $room->id }}">Reservar</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="reserveModal-{{ $room->id }}" tabindex="-1" aria-labelledby="reserveModalLabel-{{ $room->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="reserveModalLabel-{{ $room->id }}">Reservar Habitación: {{ $room->room_number }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('rooms.reserve', $room) }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="customer_id">Cliente</label>
                                                            <select name="customer_id" class="form-control" required>
                                                                @foreach($customers as $customer)
                                                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="checkin_date">Fecha de Check-in</label>
                                                            <input type="date" name="checkin_date" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="checkout_date">Fecha de Check-out</label>
                                                            <input type="date" name="checkout_date" class="form-control" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-success">Confirmar Reserva</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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
