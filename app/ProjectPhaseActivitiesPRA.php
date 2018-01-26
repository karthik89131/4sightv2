<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Http\Request;

class ProjectPhaseActivitiesPRA extends Model
{
    protected $table = 'project_phase_activity_pra';
    protected $fillable = [
        'id', 'pra_objective', 'pra_high', //todo:fill this
        'project_phase_activity'
    ];
    protected $appends = ['project_phase_activity'];
    public function _construct(){

    }

    public function save(Array $options = []){
        $old_attributes = $this->attributes;
        unset($this->attributes['project_phase_activity']);
        $result = parent::save($options);
        if (isset($old_attributes['project_phase_activity'])){
            $project_phase_activity = new ProjectPhaseActivities($old_attributes['project_phase_activity']);
            $project_phase_activity->exists = true;
            $project_phase_activity->save();
        }
        return $result;
    }

}
