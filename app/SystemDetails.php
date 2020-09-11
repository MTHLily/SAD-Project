<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemDetails extends Model
{
    
	public function storage(){
		return $this->hasMany( 'App\Storage', 'system_id' );
	}

	public function ram(){
		return $this->hasMany( 'App\Ram', 'system_id' );
	}

	public function computer(){
		return $this->hasOne( 'App\Computer' );
	}

}
