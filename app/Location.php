<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Http\Request;

class Location extends Model
{
    protected $fillable = [
        'name', 'address', 'lng', 'lat'
    ];
    protected $table = 'location';
    public function _construct(){

    }
}
