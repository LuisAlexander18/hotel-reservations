@extends('layouts.template-user')

@section('contenido')
<div class="container">
    <h1>Reporte de Administradores/Administrativos</h1><br>
    <div class="mb-3">
        <a href="{{ route('admin.reports.admins', ['format' => 'excel']) }}" class="btn btn-success">Exportar a Excel</a>
        <a href="{{ route('admin.reports.admins', ['format' => 'pdf']) }}" class="btn btn-danger">Exportar a PDF</a>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.reports.admins') }}">
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
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Identificación</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Creado en</th>
                <th>Actualizado en</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->last_name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->identification }}</td>
                <td>{{ $admin->phone }}</td>
                <td>{{ $admin->address }}</td>
                <td>{{ $admin->created_at }}</td>
                <td>{{ $admin->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $admins->links() }}
    </div>
</div>
@endsection
