@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Gestión de Reservas</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Número de Habitación <input type="text" id="filter-room-number" class="form-control" placeholder="Filtrar"></th>
                                    <th>Nombre <input type="text" id="filter-name" class="form-control" placeholder="Filtrar"></th>
                                    <th>Estado <input type="text" id="filter-status" class="form-control" placeholder="Filtrar"></th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Cliente <input type="text" id="filter-customer" class="form-control" placeholder="Filtrar"></th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="reservations-table-body">
                                @foreach($rooms as $room)
                                <tr>
                                    <td>{{ $room->room_number }}</td>
                                    <td>{{ $room->name }}</td>
                                    <td>{{ $room->status }}</td>
                                    <td>
                                        <input type="date" name="check_in_date" class="form-control" form="form-{{ $room->id }}" value="{{ $room->currentReservation->check_in_date ?? '' }}">
                                    </td>
                                    <td>
                                        <input type="date" name="check_out_date" class="form-control" form="form-{{ $room->id }}" value="{{ $room->currentReservation->check_out_date ?? '' }}">
                                    </td>
                                    <td>
                                        <select name="customer_id" class="form-control" form="form-{{ $room->id }}">
                                            <option value="">Seleccionar Cliente</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}" @if(isset($room->currentReservation) && $room->currentReservation->customer_id == $customer->id) selected @endif>{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <form id="form-{{ $room->id }}" action="{{ route('reservations.changeStatus', $room) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" name="status" value="available" class="btn btn-transparent" onclick="return confirm('¿Estás seguro de que deseas marcar esta habitación como Disponible?')">Disponible</button>
                                            <button type="submit" name="status" value="occupied" class="btn btn-danger">Reservar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.querySelectorAll('input[name="check_in_date"]').forEach(function(input) {
            input.setAttribute('min', today);
            input.addEventListener('change', function() {
                const checkOutInput = document.querySelector('input[name="check_out_date"][form="'+input.getAttribute('form')+'"]');
                checkOutInput.setAttribute('min', input.value);
            });
        });

        // Filtros
        document.getElementById('filter-room-number').addEventListener('keyup', function() {
            filterTable('filter-room-number', 0);
        });

        document.getElementById('filter-name').addEventListener('keyup', function() {
            filterTable('filter-name', 1);
        });

        document.getElementById('filter-status').addEventListener('keyup', function() {
            filterTable('filter-status', 2);
        });

        document.getElementById('filter-customer').addEventListener('keyup', function() {
            filterCustomer('filter-customer');
        });

        function filterTable(filterId, columnIndex) {
            const filter = document.getElementById(filterId).value.toLowerCase();
            const rows = document.querySelectorAll('#reservations-table-body tr');
            rows.forEach(row => {
                const cell = row.getElementsByTagName('td')[columnIndex];
                if (cell) {
                    const cellText = cell.textContent || cell.innerText;
                    row.style.display = cellText.toLowerCase().indexOf(filter) > -1 ? '' : 'none';
                }
            });
        }

        function filterCustomer(filterId) {
            const filter = document.getElementById(filterId).value.toLowerCase();
            const rows = document.querySelectorAll('#reservations-table-body tr');
            rows.forEach(row => {
                const select = row.querySelector('select[name="customer_id"]');
                const selectedOption = select.options[select.selectedIndex].text.toLowerCase();
                row.style.display = selectedOption.indexOf(filter) > -1 ? '' : 'none';
            });
        }
    });
</script>
