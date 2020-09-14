<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miscellaneous extends Model
{
    protected $fillable = ['setup_id', 'device_id'];

    public function setup(){
        return $this->belongsTo('App\PeripheralSetup');

    }
    public function device(){
        return $this->belongsTo('App\Peripheral');
    }
}
