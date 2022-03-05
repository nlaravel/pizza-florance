<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
    protected $guarded = [];
    protected $appends=['image_url'];
    public function getImageUrlAttribute(){
        return asset($this->image);
    }
}
