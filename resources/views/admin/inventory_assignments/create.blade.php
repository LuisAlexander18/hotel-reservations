@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Asignar Producto</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('inventory_assignments.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="assigned_type" class="form-label">Tipo de Asignación</label>
                            <select class="form-control" id="assigned_type" name="assigned_type" required>
                                <option value="">Seleccionar Tipo de Asignación</option>
                                <option value="room">Habitación</option>
                                <option value="admin">Administrativo</option>
                            </select>
                        </div>

                        <div class="mb-3" id="room-selection" style="display:none;">
                            <label for="room_id" class="form-label">Habitación</label>
                            <select class="form-control" id="room_id" name="room_id">
                                <option value="">Seleccionar Habitación</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->room_number }} - {{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3" id="admin-selection" style="display:none;">
                            <label for="admin_id" class="form-label">Administrativo</label>
                            <select class="form-control" id="admin_id" name="admin_id">
                                <option value="">Seleccionar Administrativo</option>
                                @foreach($admins as $admin)
                                    <option value="{{ $admin->id }}">{{ $admin->name }} {{ $admin->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="inventory_id" class="form-label">Producto</label>
                            <select class="form-control" id="inventory_id" name="inventory_id" required>
                                <option value="">Seleccionar Producto</option>
                                @foreach($inventories as $inventory)
                                    @if ($inventory->quantity > 0)
                                        <option value="{{ $inventory->id }}">{{ $inventory->name }} (Stock: {{ $inventory->quantity }})</option>
                                    @else
                                        <option value="{{ $inventory->id }}" disabled>{{ $inventory->name }} (Stock: {{ $inventory->quantity }})</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Asignar</button>
                        <a href="{{ route('inventories.index') }}" class="btn btn-transparent" onclick="return confirm('¿Estás seguro de que deseas cancelar la asignación?');">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const assignedType = document.getElementById('assigned_type');
        const roomSelection = document.getElementById('room-selection');
        const adminSelection = document.getElementById('admin-selection');

        assignedType.addEventListener('change', function() {
            if (this.value === 'room') {
                roomSelection.style.display = 'block';
                adminSelection.style.display = 'none';
            } else if (this.value === 'admin') {
                roomSelection.style.display = 'none';
                adminSelection.style.display = 'block';
            } else {
                roomSelection.style.display = 'none';
                adminSelection.style.display = 'none';
            }
        });
    });
</script>
