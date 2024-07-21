<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Reservaciones</title>
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
    <h1>Reporte de Reservaciones</h1>
    <table>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Habitación</th>
                <th>Cliente</th>
                <th>Fecha de Check-in</th>
                <th>Fecha de Check-out</th>
                <th>Estatus</th>
                <th>Creado en</th>
                <th>Actualizado en</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
            <tr>
                <td>{{ $reservation->user->name ?? 'N/A' }}</td>
                <td>{{ $reservation->room->name ?? 'N/A' }}</td>
                <td>{{ $reservation->customer->name ?? 'N/A' }}</td>
                <td>{{ $reservation->check_in_date }}</td>
                <td>{{ $reservation->check_out_date }}</td>
                <td>{{ $reservation->status }}</td>
                <td>{{ $reservation->created_at }}</td>
                <td>{{ $reservation->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
