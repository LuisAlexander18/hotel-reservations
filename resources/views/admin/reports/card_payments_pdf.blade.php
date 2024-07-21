@extends('layouts.template-user')

@section('contenido')
<div class="container">
    <h2>Pago con Tarjeta</h2>
    <form method="POST" action="{{ route('payments.processCardPayment') }}">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room_id }}">
        <input type="hidden" name="payment_method" value="card">
        <input type="hidden" name="total_amount" value="{{ $total_amount }}">

        <div class="mb-3">
            <label for="card_type" class="form-label">Tipo de Tarjeta</label>
            <select name="card_type" id="card_type" class="form-control">
                <option value="Mastercard">Mastercard</option>
                <option value="Visa">Visa</option>
                <option value="DinnersClub">DinnersClub</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="card_number" class="form-label">Número de Tarjeta</label>
            <input type="text" name="card_number" id="card_number" class="form-control" maxlength="16" pattern="\d{16}" inputmode="numeric" required>
        </div>
        <div class="mb-3">
            <label for="cvv" class="form-label">CVV</label>
            <input type="text" name="cvv" id="cvv" class="form-control" maxlength="3" pattern="\d{3}" inputmode="numeric" required>
        </div>
        <div class="mb-3">
            <label for="expiry_date" class="form-label">Fecha de Caducidad</label>
            <input type="text" name="expiry_date" id="expiry_date" class="form-control" placeholder="MM/YY" pattern="\d{2}/\d{2}" required>
        </div>
        <div class="mb-3">
            <label for="received_amount" class="form-label">Cantidad Recibida</label>
            <input type="number" name="received_amount" id="received_amount" class="form-control" value="{{ $total_amount }}" readonly required>
        </div>
        <div class="mb-3">
            <label for="additional_email" class="form-label">Email Adicional</label>
            <input type="email" name="additional_email" id="additional_email" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Pagar</button>
        <a href="{{ route('payments.create') }}" class="btn btn-transparent">Atrás</a>
    </form>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const expiryDateInput = document.getElementById('expiry_date');
    expiryDateInput.addEventListener('input', function(event) {
        const input = event.target;
        let value = input.value.replace(/\D/g, '').substring(0, 4);
        const month = value.substring(0, 2);
        const year = value.substring(2, 4);
        if (value.length >= 4) {
            value = `${month}/${year}`;
        }
        input.value = value;
    });

    const cardNumberInput = document.getElementById('card_number');
    cardNumberInput.addEventListener('input', function(event) {
        this.value = this.value.replace(/\D/g, '').substring(0, 16);
    });

    const cvvInput = document.getElementById('cvv');
    cvvInput.addEventListener('input', function(event) {
        this.value = this.value.replace(/\D/g, '').substring(0, 3);
    });
});
</script>
