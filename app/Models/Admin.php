<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'identification',
        'phone',
        'address',
    ];

    // Relación con InventoryAssignment
    public function inventoryAssignments()
    {
        return $this->morphMany(InventoryAssignment::class, 'assignable');
    }
}
