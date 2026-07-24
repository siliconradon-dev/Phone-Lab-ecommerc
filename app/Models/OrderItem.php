<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',
        'quantity',
        'unit_price',
        'price'
    ];

    // Relationship: The item belongs to an order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relationship: Fetch the product details
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship: Fetch the specific variant (e.g., RAM/Storage/Color)
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}
