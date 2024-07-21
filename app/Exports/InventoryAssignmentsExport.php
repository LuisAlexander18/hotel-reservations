<?php

namespace App\Exports;

use App\Models\InventoryAssignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventoryAssignmentsExport implements FromCollection, WithHeadings
{
    protected $inventoryAssignments;

    public function __construct($inventoryAssignments)
    {
        $this->inventoryAssignments = $inventoryAssignments;
    }

    public function collection()
    {
        return $this->inventoryAssignments->map(function ($assignment) {
            return [
                'Inventario' => $assignment->inventory->name ?? 'N/A',
                'Tipo de Asignación' => $assignment->assignable_type,
                'ID de Asignación' => $assignment->assignable_id,
                'Cantidad' => $assignment->quantity,
                'Creado en' => $assignment->created_at,
                'Actualizado en' => $assignment->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Inventario',
            'Tipo de Asignación',
            'ID de Asignación',
            'Cantidad',
            'Creado en',
            'Actualizado en',
        ];
    }
}
