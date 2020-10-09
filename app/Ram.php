<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ram extends Model
{

    protected $fillable = [
        'component_id',
        'system_id',
    ];

    public function component(){
    	return $this->belongsTo('App\Component');
    }
}
