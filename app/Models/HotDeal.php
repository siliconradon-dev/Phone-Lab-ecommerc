<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotDeal extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'discount_price', 'end_date'];

    protected $casts = [
        'end_date' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
