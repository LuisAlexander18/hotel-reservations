<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Room;
use App\Models\InventoryAssignment;
use Illuminate\Http\Request;

class InventoryAssignmentController extends Controller
{
    public function create()
    {
        $rooms = Room::all();
        $inventories = Inventory::all();
        return view('admin.inventory_assignments.create', compact('rooms', 'inventories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'inventory_id' => 'required|exists:inventories,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $inventory = Inventory::find($request->inventory_id);
        if ($inventory->quantity < $request->quantity) {
            return back()->with('error', 'No hay suficiente cantidad de producto en el inventario.');
        }

        $inventory->quantity -= $request->quantity;
        $inventory->save();

        InventoryAssignment::create([
            'room_id' => $request->room_id,
            'inventory_id' => $request->inventory_id,
            'quantity' => $request->quantity
        ]);

        return redirect()->route('inventories.index')->with('success', 'Producto asignado a la habitación exitosamente.');
    }
}
