<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return $this->users->map(function ($user) {
            return [
                'Nombre' => $user->name,
                'Email' => $user->email,
                'Rol' => $user->role,
                'Fecha de Creación' => $user->created_at,
                'Fecha de Actualización' => $user->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Email',
            'Rol',
            'Fecha de Creación',
            'Fecha de Actualización',
        ];
    }
}
