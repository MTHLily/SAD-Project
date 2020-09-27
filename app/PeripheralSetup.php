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

    public function assignment(){
        return $this->belongsTo('App\Assignment');
    }
    public function monitor(){
        return $this->hasMany('App\Monitor');
    }
    public function phone(){
        return $this->hasMany('App\Miscellaneous');
    }
    public function tablet(){
        return $this->hasMany('App\Miscellaneous');
    }
}
