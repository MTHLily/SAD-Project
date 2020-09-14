<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeripheralSetup extends Model
{
    //
    protected $fillable = [
        'assignment_id',
        'keyboard_id',
        'phone_id',
        'tablet_id',
    ];

    public function type(){
        return $this->belongsTo('App\Peripheral');
    }
    public function monitor(){
        return $this->hasMany('App\Monitor');
    }
    public function miscellaneous(){
        return $this->hasMany('App\Miscellaneous');
    }
}
