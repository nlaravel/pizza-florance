<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileManger extends Model
{
    protected $guarded = [];
    protected $appends = ['image_url'];


    public function getImageUrlAttribute(){
        if($this->name){
            return asset('images/image/'.$this->name);
        }else{
            return asset('front_assets/assets/images/default.jpg');
        }
    }







}
