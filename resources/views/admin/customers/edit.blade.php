@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Cliente</h4>
                </div>
                <div class="card-body">
                    <form id="edit-form" action="{{ route('customers.update', $customer) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="identification" class="form-label">Identificación</label>
                            <input type="text" class="form-control" id="identification" name="identification" value="{{ $customer->identification }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}">
                        </div>
                        <button type="button" class="btn btn-primary" onclick="confirmUpdate()">Actualizar</button>
                        <a href="{{ route('customers.index') }}" class="btn btn-transparent">Atrás</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function confirmUpdate() {
        if (confirm('¿Estás seguro de que deseas editar la información del cliente?')) {
            document.getElementById('edit-form').submit();
        }
    }
</script>
