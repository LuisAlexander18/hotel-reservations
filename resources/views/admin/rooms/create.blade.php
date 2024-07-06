@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Añadir Habitación</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Precio</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="capacity">Capacidad</label>
                            <input type="number" name="capacity" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="room_number">Número de Habitación</label>
                            <input type="number" name="room_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Tipo</label>
                            <input type="text" name="type" class="form-control" value="standard">
                        </div>
                        <div class="form-group">
                            <label for="image">Imagen</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
