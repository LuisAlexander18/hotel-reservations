<?php

// app/Models/Customer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'identification'
    ];

    // Mutator para normalizar el nombre del cliente
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = preg_replace('/\s+/', ' ', trim(strtolower($value)));
    }

    // Accessor para obtener el nombre del cliente en el formato original
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    // Relación con la tabla de reservas
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
