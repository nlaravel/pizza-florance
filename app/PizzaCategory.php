<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PizzaCategory extends Model
{
    protected $guarded = [];
    public function categoryParent(){
        return $this->belongsTo('App\PizzaCategory', 'parent_id');
    }
    public function childs()
    {
        return $this->hasMany(PizzaCategory::class, 'parent_id', 'id');
    }
}
