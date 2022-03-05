<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    public function people()
    {
        return $this->belongsTo(Person::class,   'person_id');
    }
}
