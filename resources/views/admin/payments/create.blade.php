@extends(request()->has('from_front') ? 'layouts.template-user-no-sidebar' : 'layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Registrar Pago</h4>
                </div>
                <div class="card-body">
                    <form id="payment-form" action="{{ route('payments.store') }}" method="POST">
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

                        <div id="room-details" style="display:none;">
                            <h5>Detalles de la Habitación</h5>
                            <p><strong>Cliente:</strong> <span id="customer-name"></span></p>
                            <p><strong>Check-in:</strong> <span id="check-in-date"></span></p>
                            <p><strong>Check-out:</strong> <span id="check-out-date"></span></p>
                            <p><strong>Días Reservados:</strong> <span id="days-reserved"></span></p>
                            <h5>Consumos Adicionales</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="additional-consumptions">
                                </tbody>
                            </table>
                            <p><strong>Subtotal:</strong> $<span id="subtotal"></span></p>
                            <p><strong>IVA:</strong> $<span id="tax-amount"></span> (<span id="tax-percentage"></span>%)</p>
                            <p><strong>Total:</strong> $<span id="total-amount"></span></p>
                            <input type="hidden" name="total_amount" id="input-total_amount">
                        </div>

                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Método de Pago</label>
                            <select class="form-control" id="payment_method" name="payment_method" required>
                                <option value="" selected disabled>Seleccione el método de pago</option>
                                <option value="cash">Efectivo</option>
                                <option value="card">Tarjeta</option>
                            </select>
                        </div>

                        <div class="mb-3" id="card-type" style="display:none;">
                            <label for="card_type" class="form-label">Tipo de Tarjeta</label>
                            <select class="form-control" id="card_type" name="card_type">
                                <option value="" selected disabled>Seleccione el tipo de tarjeta</option>
                                <option value="Mastercard">Mastercard</option>
                                <option value="Visa">Visa</option>
                                <option value="DinnersClub">Dinners Club</option>
                            </select>
                        </div>

                        <div class="mb-3" id="received-amount" style="display:none;">
                            <label for="received_amount" class="form-label">Valor Recibido</label>
                            <input type="number" step="0.01" class="form-control" id="received_amount" name="received_amount">
                            <p><strong>Cambio a Devolver:</strong> $<span id="change_amount"></span></p>
                        </div>

                        <button type="submit" class="btn btn-primary">Confirmar Pago</button>
                        <a href="{{ route('reservations.index') }}" class="btn btn-transparent">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roomSelect = document.getElementById('room_id');
        const paymentMethodSelect = document.getElementById('payment_method');
        const cardTypeDiv = document.getElementById('card-type');
        const receivedAmountDiv = document.getElementById('received-amount');
        const roomDetailsDiv = document.getElementById('room-details');
        const additionalConsumptionsTable = document.getElementById('additional-consumptions');
        const receivedAmountInput = document.getElementById('received_amount');
        const changeAmountDisplay = document.getElementById('change_amount');

        roomSelect.addEventListener('change', function() {
            if (this.value) {
                fetch(`/api/room-details/${this.value}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('customer-name').textContent = `${data.customer.name} ${data.customer.last_name}`;
                        document.getElementById('check-in-date').textContent = data.check_in_date;
                        document.getElementById('check-out-date').textContent = data.check_out_date;
                        document.getElementById('days-reserved').textContent = data.days_reserved;
                        document.getElementById('subtotal').textContent = data.subtotal.toFixed(2);
                        document.getElementById('tax-percentage').textContent = data.tax_percentage;
                        document.getElementById('tax-amount').textContent = data.tax_amount.toFixed(2);
                        document.getElementById('total-amount').textContent = data.total_amount.toFixed(2);
                        document.getElementById('input-total_amount').value = data.total_amount;

                        additionalConsumptionsTable.innerHTML = '';
                        data.inventoryAssignments.forEach(item => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${item.inventory_name}</td>
                                <td>${item.quantity}</td>
                                <td>${item.price.toFixed(2)}</td>
                                <td>${item.total.toFixed(2)}</td>
                            `;
                            additionalConsumptionsTable.appendChild(row);
                        });

                        roomDetailsDiv.style.display = 'block';
                    });
            } else {
                roomDetailsDiv.style.display = 'none';
            }
        });

        paymentMethodSelect.addEventListener('change', function() {
            const totalAmount = parseFloat(document.getElementById('input-total_amount').value);
            if (this.value === 'card') {
                cardTypeDiv.style.display = 'block';
                receivedAmountDiv.style.display = 'none';
                receivedAmountInput.value = totalAmount.toFixed(2);
                document.getElementById('payment-form').action = "{{ route('payments.store') }}";
            } else if (this.value === 'cash') {
                cardTypeDiv.style.display = 'none';
                receivedAmountDiv.style.display = 'block';
                receivedAmountInput.value = totalAmount.toFixed(2);
                receivedAmountInput.addEventListener('input', function () {
                    const receivedAmount = parseFloat(this.value);
                    const changeAmount = receivedAmount - totalAmount;
                    changeAmountDisplay.textContent = changeAmount.toFixed(2);
                });
            } else {
                cardTypeDiv.style.display = 'none';
                receivedAmountDiv.style.display = 'none';
            }
        });
    });
</script>
