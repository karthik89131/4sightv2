<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectCapacity extends Model
{
    protected $table = 'project_plant_capacity_data';
    protected $fillable = [
        'tag', 'unit', 'value', 'project_id', 'config_plant_capacity_id', 'id'
    ];
    public function _construct(){

    }
}
