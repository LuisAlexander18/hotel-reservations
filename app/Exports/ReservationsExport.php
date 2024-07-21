<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class ReservationsExport implements FromCollection, WithHeadings
{
    protected $reservations;

    public function __construct($reservations)
    {
        $this->reservations = $reservations;
    }

    public function collection()
    {
        return new Collection($this->reservations->map(function($reservation) {
            return [
                'Usuario' => $reservation->user->name ?? 'N/A',
                'Habitación' => $reservation->room->name ?? 'N/A',
                'Cliente' => $reservation->customer->name ?? 'N/A',
                'Fecha de Check-in' => $reservation->check_in_date,
                'Fecha de Check-out' => $reservation->check_out_date,
                'Estatus' => $reservation->status,
                'Creado en' => $reservation->created_at,
                'Actualizado en' => $reservation->updated_at,
            ];
        }));
    }

    public function headings(): array
    {
        return [
            'Usuario',
            'Habitación',
            'Cliente',
            'Fecha de Check-in',
            'Fecha de Check-out',
            'Estatus',
            'Creado en',
            'Actualizado en',
        ];
    }
}
