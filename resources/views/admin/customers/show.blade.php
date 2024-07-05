@extends('layouts.template-user')

@section('contenido')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Customer Details</h4>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $customer->name }}</p>
                    <p><strong>Email:</strong> {{ $customer->email }}</p>
                    <p><strong>Phone:</strong> {{ $customer->phone }}</p>
                    <p><strong>Address:</strong> {{ $customer->address }}</p>
                    <p><strong>Notes:</strong> {{ $customer->notes }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
