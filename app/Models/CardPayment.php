<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'payment_id',
        'room_id',
        'room_number',
        'amount',
        'card_number_encrypted',
        'cvv_encrypted',
        'customer_email',
        'additional_email',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function inventoryAssignment()
    {
        return $this->belongsTo(InventoryAssignment::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
