<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Http\Request;

class ProjectPhaseActivities extends Model
{
    protected $table = 'project_phase_activity';
    protected $fillable = [
        'id', 'name', 'description', 'venue', 'project_background','objective',
        'methodology', 'schedule', 'other_pmt', 'other', 'status', 'planned_date',
        'config_project_type_id', 'project_id', 'activity_standards_id', 'project_phase_id',
        'responsible_person','created_at', 'updated_at'
    ];
    protected $appends = ['activityStandard'];
    public function _construct(){

    }

    public function getActivityStandardAttribute(){
        return $this->activityStandard()->first();
    }
    public function activityStandard(){
        //return $this->belongsTo('App\ActivityStandards');
        return $this->belongsTo('App\ActivityStandards', 'activity_standards_id');
    }
}
