@extends(request()->has('room_id') ? 'layouts.template-admin' : 'layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Registrar Datos Cliente</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('customers.store') }}" method="POST">
                        @csrf
                        @if(request()->has('room_id'))
                            <input type="hidden" name="room_id" value="{{ request('room_id') }}">
                        @endif
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="identification" class="form-label">Ruc o Cédula</label>
                            <input type="text" class="form-control" id="identification" name="identification" required maxlength="13" pattern="\d{1,13}" title="Solo números, hasta 13 caracteres">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone" maxlength="10" pattern="\d{10}" title="Solo números, 10 caracteres">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('customers.index') }}" class="btn btn-transparent" onclick="return confirm('¿Estás seguro de que deseas cancelar la información agregada?');">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const identificationInput = document.getElementById('identification');
    const phoneInput = document.getElementById('phone');

    identificationInput.addEventListener('input', function(event) {
        this.value = this.value.replace(/\D/g, '').substring(0, 13);
    });

    phoneInput.addEventListener('input', function(event) {
        this.value = this.value.replace(/\D/g, '').substring(0, 10);
    });
});
</script>
@endsection
