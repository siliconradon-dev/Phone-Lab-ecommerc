<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'color', 'specific_color', 'storage', 'ram', 'model_type', 'price', 'stock_quantity', 'sku', 'is_discount', 'discount_price'];

    protected $casts = [
        'is_discount' => 'boolean',
    ];

    public function getIsDiscountedAttribute()
    {
        return $this->is_discount && $this->discount_price > 0;
    }

    public function getActivePriceAttribute()
    {
        return $this->is_discounted ? $this->discount_price : $this->price;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function mainImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_main', true);
    }

    public function getVariantStockAttribute()
    {
        $in = $this->hasMany(Stock::class, 'product_variant_id')->where('type', 'in')->sum('quantity');
        $out = $this->hasMany(Stock::class, 'product_variant_id')->where('type', 'out')->sum('quantity');

        return $in - $out;
    }

    public function imeis()
    {
        return $this->hasMany(ProductImei::class, 'product_variant_id');
    }
}
