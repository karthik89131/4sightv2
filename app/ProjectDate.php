<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ProjectDate extends Model
{
    protected $fillable = [
        'label','tag', 'value', 'project_id'
    ];
    protected $table = 'project_dates';
    public function _construct(){

    }
}
