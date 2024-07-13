<?php

// app/Http/Controllers/InventoryController.php
namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();
        return view('admin.inventories.index', compact('inventories'));
    }

    public function create()
    {
        return view('admin.inventories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'tax' => 'required|numeric|min:0|max:1'
        ]);

        $final_price = $request->price + ($request->price * $request->tax);

        Inventory::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'tax' => $request->tax,
            'final_price' => $final_price
        ]);

        return redirect()->route('inventories.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit(Inventory $inventory)
    {
        return view('admin.inventories.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'tax' => 'required|numeric|min:0|max:1'
        ]);

        $final_price = $request->price + ($request->price * $request->tax);

        $inventory->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'tax' => $request->tax,
            'final_price' => $final_price
        ]);

        return redirect()->route('inventories.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventories.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
