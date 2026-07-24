<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosOrderItem extends Model
{
    protected $fillable = [
        'pos_order_id',
        'product_id',
        'variant_id',
        'quantity',
        'price',
        'discount_type',
        'discount_value',
        'line_total',
    ];

    public function order()
    {
        return $this->belongsTo(PosOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function imeis()
    {
        return $this->hasMany(ProductImei::class, 'pos_order_item_id');
    }
}
