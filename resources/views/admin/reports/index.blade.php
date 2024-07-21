@extends('layouts.template-user')

@section('contenido')
<div class="container">
    <h1>Reportes</h1><br><br>
    <ul>
        <li><a href="{{ route('admin.reports.payments') }}">Reporte de Pagos</a></li><br>
        <li><a href="{{ route('admin.reports.reservations') }}">Reporte de Reservas</a></li><br>
        <li><a href="{{ route('admin.reports.customers') }}">Reporte de Clientes</a></li><br>
        <li><a href="{{ route('admin.reports.rooms') }}">Reporte de Habitaciones</a></li><br>
        <li><a href="{{ route('admin.reports.inventories') }}">Reporte de Inventarios</a></li><br>
        <li><a href="{{ route('admin.reports.admins') }}">Reporte de Administradores</a></li><br>
        <li><a href="{{ route('admin.reports.inventoryAssignments') }}">Reporte de Inventario Asignado</a></li><br>
        <li><a href="{{ route('admin.reports.users') }}">Reporte de Usuarios</a></li><br>
    </ul>
</div>
@endsection
