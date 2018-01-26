<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Http\Request;

class Risk extends Model
{
    protected $fillable = [
        'id', 'tag', 'project_id', 'risk_event',
        'direct_impact', 'rationale', 'existing_control',
        'mitigation_action', 'mitigation_outcome', 'cost',
        'schedule', 'hse', 'others', 'likelihood', 'overall_impact',
        'risk_rating', 'residual_likelihood','residual_impact',
        'residual_rating', 'risk_category', 'response_strategy',
        'mitigation_action_status', 'status', 'action_owner',
        'action_due', 'updated_at', 'created_at', 'project_id',
        'mitigation_trigger_point'
    ];
    protected $appends = ['project'];
    protected $table = 'risk';
    public function _construct(){

    }

    public function listing(){
        return static::all();
    }

    public static function listByUsers($user_id){
        //TODO: Check role profile
        $projects = Project::listByUsers($user_id);

        $project_ids = [];
        foreach ($projects as $project){
            $project_ids[] = $project->id;
        }
        $risks = static::whereIn('project_id', $project_ids);
        return $risks;
    }

    public function project(){
        return $this->belongsTo('App\Project');
    }
    public function getProjectAttribute(){
        return $this->project()->first();
    }
}
