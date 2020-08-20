<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{

	protected $fillable = [
		'asset_tag',
		'component_name',
		'component_type',
		'system_id',
		'warranty_id',
		'status',
	];

	public function type(){
		return $this->belongsTo('App\ComponentType');
	}

	public function warranty(){
		return $this->belongsTo('App\Warranty');
	}

}
