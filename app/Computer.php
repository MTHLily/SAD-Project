<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    protected $fillable = [
    	'asset_tag',
		'pc_name',
		'type',
		'department_id',
		'system_details_id',
		'network_details_id',
		'warranty_id',
		'remarks',
		'issues',
		'status',
    ];

    public function type(){
    	return $this->belongsTo('App\ComputerType', 'type');
    }

    public function networkDetails(){
    	return $this->belongsTo('App\NetworkDetails');
    }

    public function systemDetails(){
    	return $this->belongsTo('App\SystemDetails');
    }

	public function warranty(){
		return $this->belongsTo('App\Warranty');
	}

}
