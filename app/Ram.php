<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ram extends Model
{
    public function component(){
    	return $this->belongsTo('App\Component');
    }
}
