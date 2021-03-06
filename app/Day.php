<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $guarded = [];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
