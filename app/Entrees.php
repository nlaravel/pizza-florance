<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrees extends Model
{
    protected $guarded = [];
    protected $appends=['image_url'];

    public function getImageUrlAttribute(){
        return asset($this->image);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'entrees_products');
    }
}
