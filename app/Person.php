<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $guarded = [];

    public function states()
    {
        return $this->belongsTo(State::class,   'state_id');
    }

    public function cities()
    {
        return $this->belongsTo(City::class,   'city_id');
    }
}
