<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignable_type', 'assignable_id', 'inventory_id', 'quantity'
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
