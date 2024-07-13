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
                            <label for="inventory_id" class="form-label">Producto</label>
                            <select class="form-control" id="inventory_id" name="inventory_id" required>
                                <option value="">Seleccionar Producto</option>
                                @foreach($inventories as $inventory)
                                    <option value="{{ $inventory->id }}">{{ $inventory->name }} (Stock: {{ $inventory->quantity }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="assigned_to" class="form-label">Asignado a</label>
                            <input type="text" class="form-control" id="assigned_to" name="assigned_to" required>
                        </div>
                        <div class="mb-3">
                            <label for="assigned_type" class="form-label">Tipo de Asignación</label>
                            <select class="form-control" id="assigned_type" name="assigned_type" required>
                                <option value="room">Habitación</option>
                                <option value="admin">Administrativo</option>
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
