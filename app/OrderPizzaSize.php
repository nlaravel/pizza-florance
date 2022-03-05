<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPizzaSize extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class,   'product_id');
    }

    public function Order()
    {

        return $this->belongsTo(Order::class,   'order_id');
    }

}
