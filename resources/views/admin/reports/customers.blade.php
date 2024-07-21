@extends('layouts.template-user')

@section('contenido')
<div class="container">
    <h1>Reporte de Clientes</h1><br>
    <div class="mb-3">
        <a href="{{ route('admin.reports.customers', ['format' => 'excel']) }}" class="btn btn-success">Exportar a Excel</a>
        <a href="{{ route('admin.reports.customers', ['format' => 'pdf']) }}" class="btn btn-danger">Exportar a PDF</a>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.reports.customers') }}">
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}">
            </div>
            <div class="col-md-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ request('email') }}">
            </div>
            <div class="col-md-3">
                <label for="identification" class="form-label">Identificación</label>
                <input type="text" name="identification" id="identification" class="form-control" value="{{ request('identification') }}">
            </div>
            <div class="col-md-3">
                <label for="phone" class="form-label">Teléfono</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ request('phone') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Identificación</th>
                <th>Teléfono</th>
                <th>Creado en</th>
                <th>Actualizado en</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->identification }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->created_at }}</td>
                <td>{{ $customer->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $customers->links() }}
    </div>
</div>
@endsection
