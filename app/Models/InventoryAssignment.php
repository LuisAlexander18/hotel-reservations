<?php

// app/Models/InventoryAssignment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id', 'assignable_id', 'assignable_type', 'quantity'
    ];

    public function assignable()
    {
        return $this->morphTo();
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
