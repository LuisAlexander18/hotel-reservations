@extends('layouts.template-user')

@section('contenido')
<div class="container">
    <h1>Reporte de Inventario Asignado</h1><br>
    <div class="mb-3">
        <a href="{{ route('admin.reports.inventoryAssignments', ['format' => 'excel']) }}" class="btn btn-success">Exportar a Excel</a>
        <a href="{{ route('admin.reports.inventoryAssignments', ['format' => 'pdf']) }}" class="btn btn-danger">Exportar a PDF</a>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.reports.inventoryAssignments') }}">
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="inventory" class="form-label">Inventario</label>
                <input type="text" name="inventory" id="inventory" class="form-control" value="{{ request('inventory') }}">
            </div>
            <div class="col-md-3">
                <label for="assignable_type" class="form-label">Tipo de Asignación</label>
                <input type="text" name="assignable_type" id="assignable_type" class="form-control" value="{{ request('assignable_type') }}">
            </div>
            <div class="col-md-3">
                <label for="assignable_id" class="form-label">ID de Asignación</label>
                <input type="text" name="assignable_id" id="assignable_id" class="form-control" value="{{ request('assignable_id') }}">
            </div>
            <div class="col-md-3">
                <label for="from_date" class="form-label">Desde</label>
                <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
            </div>
            <div class="col-md-3">
                <label for="to_date" class="form-label">Hasta</label>
                <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Inventario</th>
                <th>ID de Asignación</th>
                <th>Cantidad</th>
                <th>Creado en</th>
                <th>Actualizado en</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventoryAssignments as $assignment)
            <tr>
                <td>{{ $assignment->inventory->name ?? 'N/A' }}</td>
                <td>{{ $assignment->assignable_id }}</td>
                <td>{{ $assignment->quantity }}</td>
                <td>{{ $assignment->created_at }}</td>
                <td>{{ $assignment->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $inventoryAssignments->links() }}
    </div>
</div>
@endsection
