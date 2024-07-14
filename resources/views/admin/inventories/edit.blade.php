@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Producto</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('inventories.update', $inventory) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas actualizar este producto?');">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $inventory->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description">{{ $inventory->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $inventory->price }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="tax" class="form-label">IVA</label>
                            <input type="number" step="0.01" class="form-control" id="tax" name="tax" value="{{ $inventory->tax }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $inventory->quantity }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('inventories.index') }}" class="btn btn-transparent" onclick="return confirm('¿Estás seguro de que deseas cancelar?');">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
