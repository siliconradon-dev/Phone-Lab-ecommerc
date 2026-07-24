<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'public_user_id',
        'full_name',
        'email',
        'phone',
        'title',
        'district',
        'city',
        'address',
        'landmark'
    ];

    public function publicUser()
    {
        return $this->belongsTo(PublicUser::class, 'public_user_id');
    }
}
