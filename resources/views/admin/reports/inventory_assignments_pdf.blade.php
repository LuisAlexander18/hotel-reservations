<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Inventario Asignado</title>
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
    <h1>Reporte de Inventario Asignado</h1>
    <table>
        <thead>
            <tr>
                <th>Inventario</th>
                <th>Tipo de Asignación</th>
                <th>ID de Asignación</th>
                <th>Cantidad</th>
                <th>Creado en</th>
                <th>Actualizado en</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventoryAssignments as $assignment)
            <tr>
                <td>{{ $assignment->inventory->name ?? 'N/A' }}</td>
                <td>{{ $assignment->assignable_type }}</td>
                <td>{{ $assignment->assignable_id }}</td>
                <td>{{ $assignment->quantity }}</td>
                <td>{{ $assignment->created_at }}</td>
                <td>{{ $assignment->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
