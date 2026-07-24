<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosOrder extends Model
{
    protected $fillable = [
        'customer_id',
        'cashier_id',
        'order_code',
        'payment_method',
        'total_amount',
        'paid_amount',
        'balance_amount',

        
        'subtotal',
        'bill_discount_type',
        'bill_discount_value',
        'bill_discount_amount',
    ];

    public function items()
    {
        return $this->hasMany(PosOrderItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
