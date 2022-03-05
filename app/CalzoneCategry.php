<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalzoneCategry extends Model
{
    protected $guarded = [];
    public function categoryParent(){
        return $this->belongsTo('App\CalzoneCategry', 'parent_id');
    }
    public function childs()
    {
        return $this->hasMany(CalzoneCategry::class, 'parent_id', 'id');
    }
}
