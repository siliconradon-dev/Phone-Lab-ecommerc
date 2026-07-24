<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProcess extends Model
{
    protected $fillable = ['order_id', 'order_stage_id', 'status', 'tracking_number', 'start_date', 'end_date'];

    public function stage()
    {
        return $this->belongsTo(OrderStage::class, 'order_stage_id');
    }
}
