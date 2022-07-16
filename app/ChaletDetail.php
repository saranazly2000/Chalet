<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ChaletDetail extends Model
{
    use SoftDeletes;
    public function chalet(){
        return $this->belongsTo('App\Chalet');
    }

    public function detail(){
        return $this->belongsTo('App\Detail');
    }
}
