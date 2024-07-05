@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Habitación</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('rooms.update', $room) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" class="form-control" value="{{ $room->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea name="description" class="form-control" required>{{ $room->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Precio</label>
                            <input type="number" name="price" class="form-control" value="{{ $room->price }}" required>
                        </div>
                        <div class="form-group">
                            <label for="capacity">Capacidad</label>
                            <input type="number" name="capacity" class="form-control" value="{{ $room->capacity }}" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Imagen</label>
                            <input type="file" name="image" class="form-control">
                            @if($room->image)
                                <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}" width="100">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
