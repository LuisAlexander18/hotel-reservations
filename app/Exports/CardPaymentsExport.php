<?php

namespace App\Exports;

use App\Models\CardPayment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CardPaymentsExport implements FromCollection, WithHeadings
{
    protected $cardPayments;

    public function __construct($cardPayments)
    {
        $this->cardPayments = $cardPayments;
    }

    public function collection()
    {
        return $this->cardPayments->map(function ($cardPayment) {
            return [
                'Cliente' => $cardPayment->customer->name ?? 'N/A',
                'Habitación' => $cardPayment->room->name ?? 'N/A',
                'Cantidad' => $cardPayment->amount,
                'Email Cliente' => $cardPayment->customer_email,
                'Email Adicional' => $cardPayment->additional_email,
                'Estado' => $cardPayment->status,
                'Creado en' => $cardPayment->created_at,
                'Actualizado en' => $cardPayment->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Cliente',
            'Habitación',
            'Cantidad',
            'Email Cliente',
            'Email Adicional',
            'Estado',
            'Creado en',
            'Actualizado en',
        ];
    }
}

