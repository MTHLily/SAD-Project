<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NetworkDetails extends Model
{
    protected $fillable = ['mac_address','wifi_address'];
}
