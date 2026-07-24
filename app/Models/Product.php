<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'brand', 'category', 'base_price', 'has_warranty', 'warranty_period', 'available_qty', 'has_variants', 'requires_imei', 'featured_image', 'is_discount', 'discount_price', 'is_new_arrival'];

    protected $casts = [
        'requires_imei' => 'boolean',
        'is_discount' => 'boolean',
        'is_new_arrival' => 'boolean',
    ];

    public function hotDeal()
    {
        return $this->hasOne(HotDeal::class);
    }

    public function getIsHotDealAttribute()
    {
        return $this->hotDeal !== null;
    }

    public function getHotDealEndDateAttribute()
    {
        return $this->hotDeal?->end_date;
    }

    public function getHotDealDiscountPriceAttribute()
    {
        return $this->hotDeal?->discount_price;
    }

    public function getIsHotDealActiveAttribute()
    {
        return $this->hotDeal !== null 
            && $this->hotDeal->end_date 
            && \Carbon\Carbon::parse($this->hotDeal->end_date)->isFuture() 
            && $this->hotDeal->discount_price > 0;
    }

    public function getActivePriceAttribute()
    {
        if ($this->is_hot_deal_active) {
            return $this->hotDeal->discount_price;
        }
        if ($this->is_discount && $this->discount_price > 0) {
            return $this->discount_price;
        }
        return $this->base_price;
    }

    public function getMinVariantPriceAttribute()
    {
        if ($this->has_variants && $this->variants->count() > 0) {
            return $this->variants->min(function($v) {
                return $v->active_price;
            });
        }
        return $this->active_price;
    }

    public function getMaxVariantPriceAttribute()
    {
        if ($this->has_variants && $this->variants->count() > 0) {
            return $this->variants->max(function($v) {
                return $v->active_price;
            });
        }
        return $this->active_price;
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function generalImages()
    {
        return $this->hasMany(ProductImage::class)->whereNull('product_variant_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function currentStock()
    {
        return $this->hasMany(Stock::class)->sum(DB::raw("CASE WHEN type = 'in' THEN quantity ELSE -quantity END"));
    }

    public function getStockCountAttribute()
    {
        $in = $this->hasMany(Stock::class)->where('type', 'in')->sum('quantity');
        $out = $this->hasMany(Stock::class)->where('type', 'out')->sum('quantity');

        return $in - $out;
    }

    public function imeis()
    {
        return $this->hasMany(ProductImei::class);
    }

    public function availableImeis()
    {
        return $this->hasMany(ProductImei::class)->where('status', 'available');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'product_id');
    }

    public function scopeInStock($query)
    {
        return $query->whereHas('stocks') // අවම වශයෙන් එක stock record එකක්වත් තිබිය යුතුයි
            ->whereRaw("(SELECT SUM(CASE WHEN type = 'in' THEN quantity ELSE -quantity END) FROM stocks WHERE stocks.product_id = products.id) > 0");
    }

    public function getRequiresImeiAttribute($value)
    {
        if ($value) {
            return true;
        }

        $imeiRequiredCategories = [1, 5, 8];

        return in_array($this->category_id, $imeiRequiredCategories);
    }

    public function orderItems()
    {
        return $this->hasMany(PosOrderItem::class, 'product_id');
    }

    public function reviews()
{
    return $this->hasMany(Review::class, 'product_id');
}
}
