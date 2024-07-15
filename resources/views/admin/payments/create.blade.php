@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Realizar Pago</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('payments.store') }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas confirmar el pago?');">
                        @csrf
                        <div class="mb-3">
                            <label for="room_id" class="form-label">Habitación</label>
                            <select class="form-control" id="room_id" name="room_id" required>
                                <option value="">Seleccionar Habitación</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->room_number }} - {{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Método de Pago</label>
                            <select class="form-control" id="payment_method" name="payment_method" required>
                                <option value="">Seleccionar Método de Pago</option>
                                <option value="cash">Efectivo</option>
                                <option value="card">Tarjeta</option>
                            </select>
                        </div>

                        <div class="mb-3" id="card-type-selection" style="display:none;">
                            <label for="card_type" class="form-label">Tipo de Tarjeta</label>
                            <select class="form-control" id="card_type" name="card_type">
                                <option value="">Seleccionar Tipo de Tarjeta</option>
                                <option value="Mastercard">Mastercard</option>
                                <option value="Visa">Visa</option>
                                <option value="DinnersClub">Dinners Club</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Confirmar Pago</button>
                        <a href="{{ route('inventories.index') }}" class="btn btn-transparent" onclick="return confirm('¿Estás seguro de que deseas cancelar?');">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethod = document.getElementById('payment_method');
        const cardTypeSelection = document.getElementById('card-type-selection');

        paymentMethod.addEventListener('change', function() {
            if (this.value === 'card') {
                cardTypeSelection.style.display = 'block';
            } else {
                cardTypeSelection.style.display = 'none';
            }
        });
    });
</script>
