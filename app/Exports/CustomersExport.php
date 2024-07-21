<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings
{
    protected $customers;

    public function __construct($customers)
    {
        $this->customers = $customers;
    }

    public function collection()
    {
        return $this->customers->map(function ($customer) {
            return [
                'Nombre' => $customer->name,
                'Email' => $customer->email,
                'Identificación' => $customer->identification,
                'Teléfono' => $customer->phone,
                'Creado en' => $customer->created_at,
                'Actualizado en' => $customer->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Email',
            'Identificación',
            'Teléfono',
            'Creado en',
            'Actualizado en',
        ];
    }
}
