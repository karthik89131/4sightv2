<?php
/*
 * this is to create activity standards
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Http\Request;

use App\ActivityStandardProjectPhase;

class ProjectTypePhases extends Model
{
    protected $fillable = [
        'id', 'name', 'description','activities', 'config_project_type_id', 'order'
    ];
    protected $appends = ['activities'];
    protected $table = 'config_project_type_phase';

    public function activities(){
        //$rel = $this->hasManyThrough('App\ActivityStandards', 'App\ActivityStandardProjectPhase', 'config_project_phase_id', 'id');
        $aspp_table =  ActivityStandardProjectPhase::tablename;
        $rel = $this->belongsToMany('App\ActivityStandards', $aspp_table, 'config_project_phase_id');
        return $rel;
    }

    public function getActivitiesAttribute(){
        $phases = $this->activities()->get()->toArray();
        $log = \DB::getQueryLog();
        return $phases;
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function delete(){
        $activities = ActivityStandardProjectPhase::where('config_project_phase_id', $this->id)->get();
        foreach ($activities as $activity){
            $activity->delete();
        }
        parent::delete();
    }

    public function save(Array $options = Array()){
        $old_attributes = $this->attributes;

        //filter normalized fields
        unset($this->attributes['activities']);
        parent::save($options);

        //save to activities standards
        // (business users configure this)
        if (isset($old_attributes['activities'])){
            $activities = $old_attributes['activities'];
            foreach ($activities as &$activity){
                $chkObj = [
                    'config_project_phase_id'=>$this->id,
                    'activity_standards_id'=>$activity['id']
                ];
                if (isset($activity['isDeleted']) && $activity['isDeleted']){
                    $toDelete = ActivityStandardProjectPhase::where('config_project_phase_id', $this->id);
                    $toDelete->where('activity_standards_id', $activity['id']);
                    $result = $toDelete->delete();
                } else {
                    $result = ActivityStandardProjectPhase::updateOrCreate($chkObj, $chkObj);
                    $result->save();
                }
            }
        }

        //save relationships
        return $this;
    }
}
