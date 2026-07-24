<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImei extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_variant_id',
        'imei_number',
        'status',
        'pos_order_item_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function isSold()
    {
        return $this->status === 'sold';
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }
}
