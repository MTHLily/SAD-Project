<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperatingSystem extends Model
{
    public function systems(){
    	return $this->hasMany( 'App\SystemDetails', 'department_id' );
    }
}
