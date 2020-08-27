<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{

	protected $fillable = [
		'asset_tag',
		'component_name',
		'component_type_id',
		'system_id',
		'warranty_id',
		'status',
	];

	public function type(){
		return $this->belongsTo('App\ComponentType', 'component_type_id');
	}

	public function warranty(){
		return $this->belongsTo('App\Warranty');
	}

}
