<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'capacity',
        'room_number',
        'type',
        'image',
        'status'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function currentReservation()
    {
        return $this->hasOne(Reservation::class)->latestOfMany('check_in_date');
    }
}
