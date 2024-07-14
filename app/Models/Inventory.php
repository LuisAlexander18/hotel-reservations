<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'quantity', 'tax', 'final_price'
    ];

    public function reduceStock($amount)
    {
        if ($this->quantity >= $amount) {
            $this->quantity -= $amount;
            $this->save();
            Log::info('Stock reducido en el modelo.', [
                'inventory_id' => $this->id,
                'remaining_quantity' => $this->quantity
            ]);
            return true;
        } else {
            Log::warning('Intento de reducir stock sin suficiente cantidad.', [
                'inventory_id' => $this->id,
                'requested_quantity' => $amount,
                'available_quantity' => $this->quantity
            ]);
            return false;
        }
    }
}
