@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Room</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('rooms.update', $room) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $room->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" required>{{ $room->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" class="form-control" value="{{ $room->price }}" required>
                        </div>
                        <div class="form-group">
                            <label for="capacity">Capacity</label>
                            <input type="number" name="capacity" class="form-control" value="{{ $room->capacity }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
