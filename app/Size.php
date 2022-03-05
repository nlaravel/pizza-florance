<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $guarded = [];
    protected $appends=['image_url'];
    public function getImageUrlAttribute(){
        return asset($this->image);
    }

    public function product()

    {
        return $this->belongsTo(Product::class,'product_id');

    }
}
