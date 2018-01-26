<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Http\Request;

class ProjectPhase extends Model
{
    protected $table = 'project_phase';
    protected $appends = ['activities'];
    protected $fillable = [
        'name', 'description', 'start_date', 'end_date', 'order', 'project_id', 'activities',
        'planned_start_date', 'planned_end_date', 'actual_start_date', 'actual_end_date'
    ];
    public function _construct(){

    }

    public function activities(){
        return $this->hasMany('App\ProjectPhaseActivities', 'project_phase_id', 'id');
    }

    public function getActivitiesAttribute(){
        $phases = $this->activities()->get()->toArray();
        $log = \DB::getQueryLog();
        return $phases;
    }

    public function save(Array $options = Array()){
        $old_attributes = $this->attributes;
        unset($this->attributes['activities']);
        parent::save($options);
        if (isset($old_attributes['activities'])){
            $activities = $old_attributes['activities'];
            foreach ($activities as &$activity){
                $_activity = new ProjectPhaseActivities($activity);
                if (isset($activity['id'])){
                    $_activity->exists = true;
                }
                $_activity->save();
            }
        }
    }
}
