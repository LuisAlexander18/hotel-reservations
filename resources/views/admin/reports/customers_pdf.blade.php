<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Clientes</title>
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
    <h1>Reporte de Clientes</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Identificación</th>
                <th>Teléfono</th>
                <th>Creado en</th>
                <th>Actualizado en</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->identification }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->created_at }}</td>
                <td>{{ $customer->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
