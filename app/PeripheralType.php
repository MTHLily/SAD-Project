<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeripheralType extends Model
{
    public function peripherals(){
        return $this->hasMany('App\Peripheral');
    }
}
