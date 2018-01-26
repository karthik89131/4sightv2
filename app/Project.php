<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Http\Request;

use App\ProjectPhase;
use App\ProjectType;
use App\ProjectTypePhases;
use App\ActivityStandards;
use App\ActivityStandardsPhases;

class Project extends Model
{
    use BaseModel;
    protected $table = 'project';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['capacities', 'location', 'dates', 'phases'];

    public function __construct(array $attributes = []){
        parent::__construct($attributes);
    }

   /* public function find($id){

    }*/

    protected $fillable = [
        'name', 'description', 'capex_currency', 'capex_cost', 'sanction_currency', 'sanction_cost',
        'status', 'config_project_type_id', 'config_contracting_mode_id',
        'config_contracting_mode_id', 'location_id', 'project_sponsor_id', 'project_manager_id',
        'phases', 'current_phase_id', 'id', 'config_project_classification_id', 'tag',
        'capacities', 'location', 'dates', 'config_company_id'
    ];

    public function save(Array $options = Array()){
        $_capacitites = [];
        $_location = null;
        $old_attributes = $this->attributes;

        //save normalized table that does not depend on project's ID
        if (isset($old_attributes['location'])){
            $location = $old_attributes['location'];
            $nLocation = new Location($location);
            if (isset($old_attributes['location_id'])){
                $nLocation->exists = true;
            }
            $nLocation->save();
            $location_id = $nLocation['id'];
            $this->location_id = $location_id;
        }

        //filter normalized fields
        unset($this->attributes['capacities']);
        unset($this->attributes['location']);
        unset($this->attributes['dates']);
        unset($this->attributes['phases']);
        parent::save($options);

        //save normalized tables that depends on project's ID
        if ($old_attributes['capacities']){
            $capacities = $old_attributes['capacities'];
            foreach ($capacities as $capacity){
                $capacity['project_id'] = $this->id;
                $nCapacity = new ProjectCapacity($capacity);
                if (isset($capacity['id'])){
                    $nCapacity->exists = true;
                }
                $nCapacity->save();
                $_capacitites[] = $nCapacity;
            }
        }

        if ($old_attributes['phases']){
            $phases = $old_attributes['phases'];
            foreach ($phases as $phase){
                $phase['project_id'] = $this->id;
                $_phase = new ProjectPhase($phase);
                if (isset($phase['id'])){
                    $_phase->exists = true;
                }
                $_phase->save();
            }
        }

        $project_id = $this->id;
        if ($old_attributes['dates']){
            $dates = $old_attributes['dates'];
            foreach ($dates as $key=>$value){
                //$dateO = new ProjectDate(['label'=>$key]);
                $result = ProjectDate::updateOrCreate(['tag'=>$key, 'project_id'=>$project_id],
                    ['tag'=>$key,'value'=>$value, 'project_id'=>$project_id]);
                //$dateRslt = ProjectDate::updateOrCreate()
            }
        }

        if (isset($old_attributes['config_project_type_id'])){
            if (isset($old_attributes['id'])){
                //user wants to change project type, handle it

            } else {
                //user creates new project, copy project phases and activities
                $projectType = ProjectType::find($old_attributes['config_project_type_id']);
                $phases = $projectType->phases()->get();
                foreach ($phases as $phase){
                    //copy phase
                    $projectPhase = new ProjectPhase(['name'=>$phase->name,
                        'order'=>$phase->order,
                        'description'=>$phase->description,
                        'project_id'=>$this->id]);
                    $projectPhase->save();

                    //copy activities
                    $projectTypeActivities = $phase->activities()->get();
                    foreach ($projectTypeActivities as $projectTypeActivity){
                        $projectActivity = new ProjectPhaseActivities([
                            'name'=>$projectTypeActivity->activity_name,
                            'config_project_type_id'=>$projectType->id,
                            'project_phase_id'=>$projectPhase->id,
                            'project_id'=>$this->id,
                            'activity_standards_id'=>$projectTypeActivity->id
                        ]);
                        $projectActivity->save();
                    }
                }
            }
        }

        $this->attributes['capacities'] = $_capacitites;
    }



    public static function listByUsers($userId){
        //\DB::enableQueryLog();
        $results = \DB::table('project_user')
            ->leftJoin('project', 'project.id', '=', 'project_user.project_id')
            ->select('project.*')
            ->where('project_user.user_id', $userId)
            ->where('project.id', '<>', null)
            ->get();

        $results = collect($results)->map(function($x){ return (array) $x; })->toArray();
        $_results = [];
        foreach ($results as &$result){
            $result = new Project($result);
            $_results[] = $result;
        }
        //$log = \DB::getQueryLog();
        return $_results;

    }

    public function associateUser($user_id){
        /*$projectUser = new ProjectUser([
            "user_id"=>$user_id,
            "project_id"=>$this->id
        ]);
        return $projectUser->save();*/
        return ProjectUser::updateOrCreate(
            ['user_id'=>$user_id,
             'project_id'=>$this->id],
            ['user_id'=>$user_id,
             'project_id'=>$this->id]
        );
    }



    public static function isUserAccessible($user_id, $project_id){
        $projectUser = \DB::table('project_user')
            ->where('user_id', $user_id)
            ->where('project_id', $project_id)
            ->first();
        return $projectUser;
    }

    public function getlocation(){
        \DB::enableQueryLog();
        $loc_id = $this->attributes['location_id'];
        $result = \DB::table('location')
            ->where('location.id', $loc_id)->first();
        $log = \DB::getQueryLog();
        return $result;
    }

    public function location(){
        return $this->belongsTo('App\Location');
    }

    public function dates(){
        return $this->hasMany('App\ProjectDate', 'project_id', 'id');
    }

    public function capacities(){
        return $this->hasMany('App\ProjectCapacity', 'project_id', 'id');
    }
    public function getCapacitiesAttribute(){
        $capacitites = $this->capacities()->get()->toArray();
        //$log = \DB::getQueryLog();
        return $capacitites;
    }
    public function getLocationAttribute(){
        return $this->location()->first();
    }
    public function getDatesAttribute(){
        $_dates = [];
        $dates= $this->dates()->get()->toArray();
        foreach ($dates as $date){
            $_dates[$date['tag']]=$date['value'];
            //$_dates[] = $nDate;
        }
        return $_dates;
    }
    public function getPhasesAttribute(){
        return $this->phases()->get();
    }
    public function phases(){
        //$project_phases = ProjectPhase::where('project_id', $this->attributes['id'])->get();
        $project_phases = $this->hasMany('App\ProjectPhase', 'project_id', 'id');
        return $project_phases;
    }

    public static function Types(){
        $result = \DB::table('config_project_type')->get();
        return $result;
    }
    public static function Classifications(){
        $result = \DB::table('config_project_classification')->get();
        return $result;
    }
    public static function ConfigCapacities(){
        $result = \DB::table('config_project_plant_capacity')->get();
        return $result;
    }
    public static function ContractingMOdes(){
        $result = \DB::table('config_contracting_mode')->get();
        return $result;
    }
    public static function Currencies(){
        $result = \DB::table('config_currency')->get();
        return $result;
    }
    public static function ConfigDateFields(){
        $result = \DB::table('config_project_date_type')->get();
        return $result;
    }

}
