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

	public function products(){
		return $this->hasMany( 'App\Component' );
	}

}
