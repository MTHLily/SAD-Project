<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_initial',
        'email_address',
        'department_id',
        'status',
    ];

    public function department(){
        return $this->belongsTo('App\Department');
    }

    public function full_name(){
        return $this->last_name . ', ' . $this->first_name . ' ' . $this->middle_initial . '.' ;
    }

}
