@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Clientes</h4><br><br>
                    <a href="{{ route('customers.create') }}" class="btn btn-primary">Añadir Cliente</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        Nombre
                                        <input type="text" id="filter-name" class="form-control" placeholder="Filtrar por nombre">
                                    </th>
                                    <th>
                                        Email
                                        <input type="text" id="filter-email" class="form-control" placeholder="Filtrar por email">
                                    </th>
                                    <th>
                                        Identificación
                                        <input type="text" id="filter-identification" class="form-control" placeholder="Filtrar por identificación">
                                    </th>
                                    <th>
                                        Teléfono
                                        <input type="text" id="filter-phone" class="form-control" placeholder="Filtrar por teléfono">
                                    </th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="customers-table-body">
                                @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->identification }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>
                                        @if($customer->reservations->isEmpty())
                                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">Editar</a>
                                            <form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">Eliminar</button>
                                            </form>
                                        @else
                                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning disabled" aria-disabled="true">Editar</a>
                                            <form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger disabled" aria-disabled="true">Eliminar</button>
                                            </form>
                                        @endif
                                        <a href="{{ route('reservations.index', ['customer_id' => $customer->id]) }}" class="btn btn-info">Asignar Habitación</a>
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
        // Filtros
        document.getElementById('filter-name').addEventListener('keyup', function() {
            filterTable('filter-name', 0);
        });

        document.getElementById('filter-email').addEventListener('keyup', function() {
            filterTable('filter-email', 1);
        });

        document.getElementById('filter-identification').addEventListener('keyup', function() {
            filterTable('filter-identification', 2);
        });

        document.getElementById('filter-phone').addEventListener('keyup', function() {
            filterTable('filter-phone', 3);
        });

        function filterTable(filterId, columnIndex) {
            const filter = document.getElementById(filterId).value.toLowerCase();
            const rows = document.querySelectorAll('#customers-table-body tr');
            rows.forEach(row => {
                const cell = row.getElementsByTagName('td')[columnIndex];
                if (cell) {
                    const cellText = cell.textContent || cell.innerText;
                    row.style.display = cellText.toLowerCase().indexOf(filter) > -1 ? '' : 'none';
                }
            });
        }
    });
</script>
