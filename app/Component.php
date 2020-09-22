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
		'issues',
		'remarks',
		'status',
	];

	public function type(){
		return $this->belongsTo('App\ComponentType', 'component_type_id');
	}

	public function warranty(){
		return $this->belongsTo('App\Warranty');
	}

	public static function motherboards(){
		return Component::where( 'component_type_id', 1 );
	}
	public static function cpus(){
		return Component::where( 'component_type_id', 2 );
	}
	public static function gpus(){
		return Component::where( 'component_type_id', 3 );
	}
	public static function rams(){
		return Component::where( 'component_type_id', 4 );
	}
	public static function storages(){
		return Component::where( 'component_type_id', 5 );
	}

}
