<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $appends=['image_url'];

    public function getImageUrlAttribute(){
        return asset($this->image);
    }
    public function categories()
    {
        return $this->belongsTo(Category::class,   'category_id');
    }
    public function extras()
    {
        return $this->hasMany(Extra::class);
    }
    public function sizes()
    {
        return $this->hasMany(Size::class);
    }

    public function days()
    {
        return $this->belongsToMany(Day::class);
    }
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function entrees()
    {
        return $this->belongsToMany(Product::class, 'entrees_products');
    }




}
