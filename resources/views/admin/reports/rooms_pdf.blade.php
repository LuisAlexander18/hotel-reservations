<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Habitaciones</title>
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
    <h1>Reporte de Habitaciones</h1>
    <table>
        <thead>
            <tr>
                <th>Número de Habitación</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Capacidad</th>
                <th>Creado en</th>
                <th>Actualizado en</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
            <tr>
                <td>{{ $room->room_number }}</td>
                <td>{{ $room->type }}</td>
                <td>{{ $room->price }}</td>
                <td>{{ $room->status }}</td>
                <td>{{ $room->name }}</td>
                <td>{{ $room->description }}</td>
                <td>{{ $room->capacity }}</td>
                <td>{{ $room->created_at }}</td>
                <td>{{ $room->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
