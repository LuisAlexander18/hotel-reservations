@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Inventario y Precio de Productos</h4><br><br>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('inventories.create') }}" class="btn btn-primary">Añadir Producto</a>
                        <a href="{{ route('inventory_assignments.create') }}" class="btn btn-success">Asignar Producto a Habitación</a>
                    </div>
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
                                        Descripción
                                        <input type="text" id="filter-description" class="form-control" placeholder="Filtrar por descripción">
                                    </th>
                                    <th>
                                        Subtotal
                                        <input type="number" id="filter-subtotal" class="form-control" placeholder="Filtrar por subtotal">
                                    </th>
                                    <th>
                                        Valor del IVA
                                        <input type="number" id="filter-tax" class="form-control" placeholder="Filtrar por valor del IVA">
                                    </th>
                                    <th>
                                        Precio Total
                                        <input type="number" id="filter-final-price" class="form-control" placeholder="Filtrar por precio total">
                                    </th>
                                    <th>
                                        Cantidad
                                        <input type="number" id="filter-quantity" class="form-control" placeholder="Filtrar por cantidad">
                                    </th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="inventories-table-body">
                                @foreach($inventories as $inventory)
                                <tr>
                                    <td>{{ $inventory->name }}</td>
                                    <td>{{ $inventory->description }}</td>
                                    <td>{{ $inventory->price }}</td>
                                    <td>{{ $inventory->price * $inventory->tax }}</td>
                                    <td>{{ $inventory->final_price }}</td>
                                    <td>{{ $inventory->quantity }}</td>
                                    <td>
                                        <a href="{{ route('inventories.edit', $inventory) }}" class="btn btn-warning">Editar</a>
                                        <form action="{{ route('inventories.destroy', $inventory) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</button>
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
        // Filtros
        document.getElementById('filter-name').addEventListener('keyup', function() {
            filterTable('filter-name', 0);
        });

        document.getElementById('filter-description').addEventListener('keyup', function() {
            filterTable('filter-description', 1);
        });

        document.getElementById('filter-subtotal').addEventListener('keyup', function() {
            filterTable('filter-subtotal', 2);
        });

        document.getElementById('filter-tax').addEventListener('keyup', function() {
            filterTable('filter-tax', 3);
        });

        document.getElementById('filter-final-price').addEventListener('keyup', function() {
            filterTable('filter-final-price', 4);
        });

        document.getElementById('filter-quantity').addEventListener('keyup', function() {
            filterTable('filter-quantity', 5);
        });

        function filterTable(filterId, columnIndex) {
            const filter = document.getElementById(filterId).value.toLowerCase();
            const rows = document.querySelectorAll('#inventories-table-body tr');
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
