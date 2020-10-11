<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peripheral extends Model
{
    protected $fillable = [
        'asset_tag',
        'peripheral_name',
        'assignment_id',
        'peripheral_type',
        'warranty_id',
        'status',
		'issues',
		'remarks'
    ];

    public function type(){
        return $this->belongsTo('App\PeripheralType', 'peripheral_type');
    }
    public function warranty(){
        return $this->belongsTo('App\Warranty');
    }
}
