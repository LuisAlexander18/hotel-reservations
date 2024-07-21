@extends('layouts.template-user')

@section('contenido')
<div class="container">
    <h1>Reporte de Pagos</h1><br>
    <form method="GET" action="{{ route('admin.reports.payments') }}">
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="room" class="form-label">Habitación</label>
                <input type="text" name="room" id="room" class="form-control" value="{{ request('room') }}">
            </div>
            <div class="col-md-3">
                <label for="customer" class="form-label">Cliente</label>
                <input type="text" name="customer" id="customer" class="form-control" value="{{ request('customer') }}">
            </div>
            <div class="col-md-3">
                <label for="user" class="form-label">Usuario</label>
                <input type="text" name="user" id="user" class="form-control" value="{{ request('user') }}">
            </div>
            <div class="col-md-3">
                <label for="payment_method" class="form-label">Método de Pago</label>
                <select name="payment_method" id="payment_method" class="form-control">
                    <option value="">Todos</option>
                    <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Efectivo</option>
                    <option value="card" {{ request('payment_method') == 'card' ? 'selected' : '' }}>Tarjeta</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="from_date" class="form-label">Desde Fecha</label>
                <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
            </div>
            <div class="col-md-3">
                <label for="to_date" class="form-label">Hasta Fecha</label>
                <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
            </div>
            <div class="col-md-3 align-self-end">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <div class="mb-3">
        <a href="{{ route('admin.reports.payments', array_merge(request()->query(), ['format' => 'excel'])) }}" class="btn btn-success">Exportar a Excel</a>
        <a href="{{ route('admin.reports.payments', array_merge(request()->query(), ['format' => 'pdf'])) }}" class="btn btn-danger">Exportar a PDF</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Habitación</th>
                <th>Cliente</th>
                <th>Usuario</th>
                <th>Subtotal</th>
                <th>% Iva</th>
                <th>Total Iva</th>
                <th>Total</th>
                <th>Método de Pago</th>
                <th>Tarjeta</th>
                <th>Fecha Pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->room->name ?? 'N/A' }}</td>
                <td>{{ $payment->customer->name ?? 'N/A' }}</td>
                <td>{{ $payment->user->name ?? 'N/A' }}</td>
                <td>{{ $payment->subtotal }}</td>
                <td>{{ $payment->tax_percentage }}</td>
                <td>{{ $payment->tax_amount }}</td>
                <td>{{ $payment->total_amount }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->card_type ?? 'N/A' }}</td>
                <td>{{ $payment->payment_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $payments->links() }}
    </div>
</div>
@endsection
