<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Pagos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Reporte de Pagos</h1>
    <table>
        <thead>
            <tr>
                <th>Habitación</th>
                <th>Cliente</th>
                <th>Usuario</th>
                <th>Subtotal</th>
                <th>% IVA</th>
                <th>Total IVA</th>
                <th>Total</th>
                <th>Método de Pago</th>
                <th>Tipo de Tarjeta</th>
                <th>Fecha de Pago</th>
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
</body>
</html>
