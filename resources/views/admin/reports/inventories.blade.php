@extends('layouts.template-user')

@section('contenido')
<div class="container">
    <h1>Reporte de Inventarios</h1><br>
    <div class="mb-3">
        <a href="{{ route('admin.reports.inventories', ['format' => 'excel']) }}" class="btn btn-success">Exportar a Excel</a>
        <a href="{{ route('admin.reports.inventories', ['format' => 'pdf']) }}" class="btn btn-danger">Exportar a PDF</a>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.reports.inventories') }}">
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}">
            </div>
            <div class="col-md-3">
                <label for="price_from" class="form-label">Precio Desde</label>
                <input type="number" step="0.01" name="price_from" id="price_from" class="form-control" value="{{ request('price_from') }}">
            </div>
            <div class="col-md-3">
                <label for="price_to" class="form-label">Precio Hasta</label>
                <input type="number" step="0.01" name="price_to" id="price_to" class="form-control" value="{{ request('price_to') }}">
            </div>
            <div class="col-md-3">
                <label for="quantity_from" class="form-label">Cantidad Desde</label>
                <input type="number" name="quantity_from" id="quantity_from" class="form-control" value="{{ request('quantity_from') }}">
            </div>
            <div class="col-md-3">
                <label for="quantity_to" class="form-label">Cantidad Hasta</label>
                <input type="number" name="quantity_to" id="quantity_to" class="form-control" value="{{ request('quantity_to') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Valor Unitario</th>
                <th>Cantidad</th>
                <th>% Iva</th>
                <th>Precio Final</th>
                <th>Creado en</th>
                <th>Actualizado en</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventories as $inventory)
            <tr>
                <td>{{ $inventory->name }}</td>
                <td>{{ $inventory->description }}</td>
                <td>{{ $inventory->price }}</td>
                <td>{{ $inventory->quantity }}</td>
                <td>{{ $inventory->tax }}</td>
                <td>{{ $inventory->final_price }}</td>
                <td>{{ $inventory->created_at }}</td>
                <td>{{ $inventory->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $inventories->links() }}
    </div>
</div>
@endsection
