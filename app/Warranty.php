<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    protected $fillable = [ 
    	'brand_id',
		'purchase_date',
		'location',
		'receipt_url',
		'serial_no',
		'warranty_life',
		'notes',
		'status', 
	];

	public function brand(){
		return $this->belongsTo( 'App\Brand' );
	}

	public function component(){
		return $this->hasMany( 'App\Component' );
	}
	
	public function computer(){
		return $this->hasMany( 'App\Computer' );
	}

	public function peripheral(){
		return $this->hasMany('App\Peripheral');
	}

	public function type(){
		if( $this->peripheral != null )
			return "Peripheral";
		if( $this->computer != null )
			return "Computer";
		return "Component";
	}

}
