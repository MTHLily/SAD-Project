<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Department extends Model
{

	use SoftDeletes;
    protected $fillable = [ 'department_name' ];

    //Get all computers in the department
    public function computers(){
    	return $this->hasMany( 'App\Computer', 'department_id' );
    }

}
