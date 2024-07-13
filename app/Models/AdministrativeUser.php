<?php

// app/Models/AdministrativeUser.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrativeUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'identification', 'phone', 'address'
    ];

    public function inventoryAssignments()
    {
        return $this->morphMany(InventoryAssignment::class, 'assignable');
    }
}
