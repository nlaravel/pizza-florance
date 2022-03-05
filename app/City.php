<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    public function states()
    {
        return $this->belongsTo(State::class,   'state_id');
    }

    public function zip_codes()
    {
        return $this->hasMany(ZipCode::class);
    }
}
