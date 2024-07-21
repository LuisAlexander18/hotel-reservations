<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Inventarios</title>
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
    <h1>Reporte de Inventarios</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Impuesto</th>
                <th>Precio Final</th>
                <th>Creado en</th>
                <th>Actualizado en</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventories as $inventory)
            <tr>
                <td>{{ $inventory->name }}</td>
                <td>{{ $inventory->description }}</td>
                <td>{{ $inventory->price }}</td>
                <td>{{ $inventory->quantity }}</td>
                <td>{{ $inventory->tax }}</td>
                <td>{{ $inventory->final_price }}</td>
                <td>{{ $inventory->created_at }}</td>
                <td>{{ $inventory->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
