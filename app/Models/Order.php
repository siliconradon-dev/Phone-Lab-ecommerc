<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'public_user_id',
        'guest_email',
        'order_code',
        'full_name',
        'company',
        'address',
        'postcode',
        'city',
        'district',
        'phone',
        'email',
        'notes',
        'payment_method',
        'total',
        'order_status',
        'payment_status'
    ];

    // Relationship: One Order has many items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relationship: Optional link to the user
    public function user()
    {
        return $this->belongsTo(PublicUser::class, 'public_user_id');
    }

    public function orderProcesses()
    {
        return $this->hasMany(OrderProcess::class, 'order_id');
    }
}
