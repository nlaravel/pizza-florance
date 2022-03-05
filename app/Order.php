<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $appends =['total_price'];
    public function people()
    {
        return $this->belongsTo(Person::class,   'person_id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class,   'product_id');
    }
    public function OrderSpecialPizzaSize()
    {
        return $this->hasMany(OrderSpecialPizzaSize::class);
    }
    public function OrderSpecialPizzaTypes()
    {
        return $this->hasMany(OrderSpecialPizzaTypes::class);
    }

    public function OrderPizzaSize()
    {
        return $this->hasMany(OrderPizzaSize::class);
    }
    public function OrderPizzaExtras()
    {
        return $this->hasMany(OrderPizzaExtras::class);
    }


    public function getTotalPriceAttribute()
    {
        return $this->order_price * $this->quantity;
    }
}
