<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('reservations')->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'nullable|string|max:15',
            'identification' => 'required|string|max:255|unique:customers',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Cliente creado exitosamente.');
    }

    public function edit(Customer $customer)
    {
        // Verificar si el cliente tiene reservas
        if (!$customer->reservations->isEmpty()) {
            return redirect()->route('customers.index')->with('error', 'No se puede editar un cliente con reservas activas.');
        }

        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:15',
            'identification' => 'required|string|max:255|unique:customers,identification,' . $customer->id,
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Cliente actualizado exitosamente.');
    }

    public function destroy(Customer $customer)
    {
        // Verificar si el cliente tiene reservas
        if (!$customer->reservations->isEmpty()) {
            return redirect()->route('customers.index')->with('error', 'No se puede eliminar un cliente con reservas activas.');
        }

        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
