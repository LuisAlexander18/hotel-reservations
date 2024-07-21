<?php

namespace App\Exports;

use App\Models\Room;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RoomsExport implements FromCollection, WithHeadings
{
    protected $rooms;

    public function __construct($rooms)
    {
        $this->rooms = $rooms;
    }

    public function collection()
    {
        return $this->rooms->map(function ($room) {
            return [
                'Número de Habitación' => $room->room_number,
                'Tipo' => $room->type,
                'Precio' => $room->price,
                'Estado' => $room->status,
                'Nombre' => $room->name,
                'Descripción' => $room->description,
                'Capacidad' => $room->capacity,
                'Creado en' => $room->created_at,
                'Actualizado en' => $room->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Número de Habitación',
            'Tipo',
            'Precio',
            'Estado',
            'Nombre',
            'Descripción',
            'Capacidad',
            'Creado en',
            'Actualizado en',
        ];
    }
}
