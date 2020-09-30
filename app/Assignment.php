<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    //
    protected $fillable = [
        'employee_id',
        'computer_id',
        'peripheral_setup_id',
    ];
    
    public function setup(){
        return $this->belongsTo('App\PeripheralSetup');
    }
    public function employee(){
        return $this->belongsTo('App\Employee');
    }
    public function computer(){
        return $this->belongsTo('App\Computer');
    }
    
}
