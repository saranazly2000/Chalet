<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Detail extends Model
{
    use SoftDeletes;
    public function chalet(){
        return $this->belongsTo('App\Chalet');
    }
}
