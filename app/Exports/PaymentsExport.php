<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentsExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return Payment::with(['room', 'customer', 'user', 'reservation']);
    }

    public function headings(): array
    {
        return [
            'Habitación',
            'Cliente',
            'Usuario',
            'Subtotal',
            '% IVA',
            'Total IVA',
            'Total',
            'Método de Pago',
            'Tipo de Tarjeta',
            'Fecha de Pago'
        ];
    }

    public function map($payment): array
    {
        return [
            $payment->room->name ?? 'N/A',
            $payment->customer->name ?? 'N/A',
            $payment->user->name ?? 'N/A',
            $payment->subtotal,
            $payment->tax_percentage,
            $payment->tax_amount,
            $payment->total_amount,
            $payment->payment_method,
            $payment->card_type ?? 'N/A',
            $payment->payment_date
        ];
    }
}
