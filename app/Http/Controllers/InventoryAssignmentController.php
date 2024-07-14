<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Room;
use App\Models\Admin;
use App\Models\InventoryAssignment;
use Illuminate\Http\Request;

class InventoryAssignmentController extends Controller
{
    public function create()
    {
        $inventories = Inventory::all();
        $rooms = Room::all();
        $admins = Admin::all();
        return view('admin.inventory_assignments.create', compact('inventories', 'rooms', 'admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'assigned_type' => 'required|string|in:room,admin',
            'room_id' => 'required_if:assigned_type,room|nullable|exists:rooms,id',
            'admin_id' => 'required_if:assigned_type,admin|nullable|exists:admins,id',
            'inventory_id' => 'required|exists:inventories,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $inventory = Inventory::find($request->inventory_id);

        // Verificar stock
        if ($request->quantity > $inventory->quantity) {
            return redirect()->back()->with('error', 'No hay suficiente stock disponible.');
        }

        // Crear la asignación de inventario
        InventoryAssignment::create([
            'inventory_id' => $request->inventory_id,
            'assignable_type' => $request->assigned_type == 'room' ? Room::class : Admin::class,
            'assignable_id' => $request->assigned_type == 'room' ? $request->room_id : $request->admin_id,
            'quantity' => $request->quantity
        ]);

        // Reducir el stock del inventario
        $inventory->quantity -= $request->quantity;
        $inventory->save();

        return redirect()->route('inventories.index')->with('success', 'Producto asignado exitosamente.');
    }
}
