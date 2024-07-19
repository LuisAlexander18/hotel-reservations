<!DOCTYPE html>
<html>
<head>
    <title>Pago Exitoso</title>
</head>
<body>
    <h1>Pago Exitoso</h1>
    <p>Estimado/a {{ $payment->customer->name }},</p>
    <p>Su pago de ${{ $payment->total_amount }} ha sido procesado exitosamente.</p>
    <p>Detalles del pago:</p>
    <ul>
        <li>Habitación: {{ $payment->room->room_number }}</li>
        <li>Fecha de Check-in: {{ $payment->reservation->check_in_date }}</li>
        <li>Fecha de Check-out: {{ $payment->reservation->check_out_date }}</li>
        <li>Monto Total: ${{ $payment->total_amount }}</li>
        <li>Método de Pago: {{ $payment->payment_method }}</li>
        <li>Fecha de Pago: {{ $payment->payment_date }}</li>
    </ul>
    <p>Gracias por su preferencia.</p>
</body>
</html>
