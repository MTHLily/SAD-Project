<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    protected $fillable = ['setup_id','monitor_id'];

    public function setup(){
        return $this->belongsTo('App\PeripheralSetup');
    }
    public function monitor(){
        return $this->belongsTo('App\Peripheral');
    }
}

