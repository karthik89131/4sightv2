<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Http\Request;

use App\ProjectTypePhases;

class ProjectType extends Model
{
    use BaseModel;
    protected $table = 'config_project_type';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['phases'];

    public function __construct(array $attributes = []){
        parent::__construct($attributes);
    }

   /* public function find($id){

    }*/

    protected $fillable = [
        'id','name', 'description', 'created_at', 'updated_at', 'phases'
    ];



    public function save(Array $options = Array()){
        $old_attributes = $this->attributes;



        //filter normalized fields
        unset($this->attributes['phases']);
        parent::save($options);

        //save to activities standards
        // (business users configure this)
        if (isset($old_attributes['phases'])){
            $phases = $old_attributes['phases'];
            foreach ($phases as &$phase){
                $phase['config_project_type_id'] = $this->id;
                $_phase = new ProjectTypePhases($phase);
                if (isset($phase['id'])){
                    $_phase->exists = true;
                }
                $_phase->save();
                //$this->update_project_phase($_phase->id);
            }
        }

        //save relationships
        return $this;
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function delete(){
        $phases = $this->phases()->get();
        foreach ($phases as $phase){
            $phase->delete();
        }
        parent::delete();
    }

    public function update_project_phase($activity_id){
        return ProjectTypePhases::updateOrCreate(
            ['activity_standards_id'=>$activity_id,
                'config_project_type_id'=>$this->id],
            ['activity_standards_id'=>$activity_id,
                'config_project_type_id'=>$this->id]
        );
    }

    /*public function getActivitiesAttribute(){
        $activities = $this->activities()->get()->toArray();
        $log = \DB::getQueryLog();
        return $activities;
    }

    public function activities(){
        return $this->hasManyThrough('App\ActivityStandards', 'App\ActivityStandardProjectType', 'config_project_type_id', 'id');
    }*/

    public function getPhasesAttribute(){
        $phases = $this->phases()->get()->toArray();
        $log = \DB::getQueryLog();
        return $phases;
    }

    public function phases(){
        return $this->hasMany('App\ProjectTypePhases', 'config_project_type_id');
    }
}
