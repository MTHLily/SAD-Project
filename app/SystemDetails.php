<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemDetails extends Model
{

	protected $fillable = [
		'motherboard_id',
		'processor_id',
		'gpu_id',
		'operating_system_id',
	];
    
	public function storage(){
		return $this->hasMany( 'App\Storage', 'system_id' );
	}

	public function ram(){
		return $this->hasMany( 'App\Ram', 'system_id' );
	}

	public function computer(){
		return $this->hasOne( 'App\Computer' );
	}

	public function motherboard(){
		return $this->belongsTo( 'App\Component', 'motherboard_id' );
	}

	public function processor(){
		return $this->belongsTo( 'App\Component', 'processor_id' );
	}

	public function gpu(){
		return $this->belongsTo( 'App\Component', 'gpu_id' );
	}

	public function operating_system(){
		return $this->belongsTo( 'App\OperatingSystem', 'operating_system_id');
	}

}
