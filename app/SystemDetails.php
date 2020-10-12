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
	
	public function isComplete(){
		return $this->motherboard_id != null && 
			$this->processor_id != null &&
			$this->gpu_id != null &&
			$this->operating_system_id != null;
	}

	public function storage(){
		return $this->hasMany( 'App\Storage', 'system_id' );
	}

	public function addStorage($component_id)
	{
		$storage = \App\Storage::firstOrNew([
			'component_id' => $component_id,
		]);
		$storage->system_id = $this->id;
		$storage->save();

		$component = \App\Component::find($component_id);
		$component->status = 'Assigned';
		$component->save();
	}

	public function clearStorage()
	{
		foreach ($this->storage as $storage) {
			$storage->system_id = null;
			$storage->save();

			$component = \App\Component::find($storage->component_id);
			$component->status = 'Available';
			$component->save();
		}
	}

	public function ram(){
		return $this->hasMany( 'App\Ram', 'system_id' );
	}

	public function addRam( $component_id ){
		$ram = \App\Ram::firstOrNew([
			'component_id' => $component_id,
		]);
		$ram->system_id = $this->id;
		$ram->save();

		$component = \App\Component::find($component_id);
		$component->status = 'Assigned';
		$component->save();

	}

	public function clearRam(){
		foreach( $this->ram as $ram ){
			$ram->system_id = null;
			$ram->save();

			$component = \App\Component::find($ram->component_id);
			$component->status = 'Available';
			$component->save();
		}
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
