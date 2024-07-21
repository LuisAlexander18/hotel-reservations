<?php

namespace App\Exports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminsExport implements FromCollection, WithHeadings
{
    protected $admins;

    public function __construct($admins)
    {
        $this->admins = $admins;
    }

    public function collection()
    {
        return $this->admins->map(function ($admin) {
            return [
                'Nombre' => $admin->name,
                'Apellido' => $admin->last_name,
                'Email' => $admin->email,
                'Identificación' => $admin->identification,
                'Teléfono' => $admin->phone,
                'Dirección' => $admin->address,
                'Creado en' => $admin->created_at,
                'Actualizado en' => $admin->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Apellido',
            'Email',
            'Identificación',
            'Teléfono',
            'Dirección',
            'Creado en',
            'Actualizado en',
        ];
    }
}
