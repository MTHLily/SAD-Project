<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComputerType extends Model
{
    
	public function computers(){
    	return $this->hasMany('App\Computer', 'type');
	}

}
