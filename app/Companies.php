<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    protected $table = 'config_company';
    protected $fillable = [
        'name', 'description'
    ];
    public function _construct(){

    }
}
