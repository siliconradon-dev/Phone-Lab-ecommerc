<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_variant_id',
        'quantity',
        'type', // 'in' or 'out'
        'note'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function imeis()
    {
        return $this->hasMany(ProductImei::class, 'product_id', 'product_id')
            ->where('product_variant_id', $this->product_variant_id);
    }
}
