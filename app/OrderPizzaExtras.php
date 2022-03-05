<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPizzaExtras extends Model
{
    protected $guarded = [];

    public function Order()
    {

        return $this->belongsTo(Order::class,   'order_id');
    }
}
