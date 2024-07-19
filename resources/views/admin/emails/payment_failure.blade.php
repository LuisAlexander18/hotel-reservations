<!DOCTYPE html>
<html>
<head>
    <title>Pago Rechazado</title>
</head>
<body>
    <h1>Pago Rechazado</h1>
    <p>Estimado/a {{ $payment->customer->name }},</p>
    <p>Lamentablemente, su pago de ${{ $payment->total_amount }} ha sido rechazado.</p>
    <p>Por favor, intente nuevamente o contacte a su banco para más detalles.</p>
    <p>Detalles del pago:</p>
    <ul>
        <li>Habitación: {{ $payment->room->room_number }}</li>
        <li>Fecha de Check-in: {{ $payment->reservation->check_in_date }}</li>
        <li>Fecha de Check-out: {{ $payment->reservation->check_out_date }}</li>
    </ul>
    <p>Gracias por su preferencia.</p>
</body>
</html>
