<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Member extends Model
{
    use SoftDeletes;
    public function chalets(){
        return $this->hasMany('App\Chalet');
    }

    public function rates(){
        return $this->hasMany('App\Rate');
    }
}
