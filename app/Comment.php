<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Comment extends Model
{
    use SoftDeletes;
    public function chalet(){
        return $this->belongsTo('App\Chalet');
    }


    public function member(){
        return $this->belongsTo('App\Member');
    }
}
