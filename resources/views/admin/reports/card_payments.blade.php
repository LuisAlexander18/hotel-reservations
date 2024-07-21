@extends('layouts.template-user')

@section('contenido')
<div class="container">
    <h1>Reporte de Pagos con Tarjeta</h1><br>
    <div class="mb-3">
        <a href="{{ route('admin.reports.cardPayments', ['format' => 'excel']) }}" class="btn btn-success">Exportar a Excel</a>
        <a href="{{ route('admin.reports.cardPayments', ['format' => 'pdf']) }}" class="btn btn-danger">Exportar a PDF</a>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.reports.cardPayments') }}">
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="customer" class="form-label">Cliente</label>
                <input type="text" name="customer" id="customer" class="form-control" value="{{ request('customer') }}">
            </div>
            <div class="col-md-3">
                <label for="room" class="form-label">Habitación</label>
                <input type="text" name="room" id="room" class="form-control" value="{{ request('room') }}">
            </div>

            <div class="col-md-3">
                <label for="status" class="form-label">Estado</label>
                <select name="status" id="status" class="form-control">
                    <option value="">Todos</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Aprobado</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rechazado</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="from_date" class="form-label">Desde</label>
                <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
            </div>
            <div class="col-md-3">
                <label for="to_date" class="form-label">Hasta</label>
                <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Habitación</th>
                <th>Cantidad</th>
                <th>Email Cliente</th>
                <th>Email Adicional</th>
                <th>Estado</th>
                <th>Creado en</th>
                <th>Actualizado en</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cardPayments as $cardPayment)
            <tr>
                <td>{{ $cardPayment->customer->name ?? 'N/A' }}</td>
                <td>{{ $cardPayment->room->name ?? 'N/A' }}</td>
                <td>{{ $cardPayment->amount }}</td>
                <td>{{ $cardPayment->customer_email }}</td>
                <td>{{ $cardPayment->additional_email }}</td>
                <td>{{ $cardPayment->status }}</td>
                <td>{{ $cardPayment->created_at }}</td>
                <td>{{ $cardPayment->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $cardPayments->links() }}
    </div>
</div>
@endsection
