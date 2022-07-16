<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Chalet extends Model
{
    use SoftDeletes;

    public function member(){
        return $this->belongsTo('App\Member');
    }

    public function images(){
        return $this->hasMany('App\Image');
    }


    public function comments(){
        return $this->hasMany('App\Comment');
    }


    public function rates(){
        return $this->hasMany('App\Rate');
    }

    public function prices(){
        return $this->hasMany('App\Price');
    }
    public function services(){
        return $this->hasMany('App\Service');
    }
    public function chaletservices(){
        return $this->hasMany('App\ChaletService');
    }
    public function details(){
        return $this->hasMany('App\Detail');
    }
    public function reservations(){
        return $this->hasMany('App\Reservation');
    }

  
}
