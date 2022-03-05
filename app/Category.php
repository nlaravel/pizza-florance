<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    protected $appends=['image_url'];
    public function getImageUrlAttribute(){
        return asset($this->image);
    }

    public function categoryParent(){
        return $this->belongsTo('App\Category', 'parent_id');
    }
    public function sizes()
    {
        return $this->hasMany(GeneralSize::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
