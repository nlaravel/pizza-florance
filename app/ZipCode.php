<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    protected $guarded = [];

    public function cities()
    {
        return $this->belongsTo(City::class,   'city_id');
    }
}
