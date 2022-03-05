<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];
    protected $appends=['logo_url','favicon_url'];
    public function getLogoUrlAttribute(){
        return asset($this->logo);
    }

    public function getFaviconUrlAttribute(){
        return asset($this->favicon);
    }

}
