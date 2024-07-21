<?php

namespace App\Exports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventoriesExport implements FromCollection, WithHeadings
{
    protected $inventories;

    public function __construct($inventories)
    {
        $this->inventories = $inventories;
    }

    public function collection()
    {
        return $this->inventories->map(function ($inventory) {
            return [
                'Nombre' => $inventory->name,
                'Descripción' => $inventory->description,
                'Precio' => $inventory->price,
                'Cantidad' => $inventory->quantity,
                'Impuesto' => $inventory->tax,
                'Precio Final' => $inventory->final_price,
                'Creado en' => $inventory->created_at,
                'Actualizado en' => $inventory->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Descripción',
            'Precio',
            'Cantidad',
            'Impuesto',
            'Precio Final',
            'Creado en',
            'Actualizado en',
        ];
    }
}
