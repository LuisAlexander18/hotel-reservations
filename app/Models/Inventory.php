<?php

// app/Models/Inventory.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'quantity', 'tax', 'final_price'
    ];

    public function assignments()
    {
        return $this->hasMany(InventoryAssignment::class);
    }
}
