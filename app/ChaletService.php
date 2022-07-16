<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChaletService extends Model
{
    use SoftDeletes;
    public function chalet(){
        return $this->belongsTo('App\Chalet');
    }

    public function service(){
        return $this->belongsTo('App\Service');
    }
}
