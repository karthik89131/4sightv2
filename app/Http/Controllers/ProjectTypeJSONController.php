<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\ProjectType;
use App\ActivityStandards;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProjectTypeJSONController extends Controller {


    public function listing(){
        \DB::enableQueryLog();
        $projectTypes = ProjectType::all();
        return $projectTypes;
    }
    /**
     * Upserts project type
     * @param Request
     * @return Response
     */
	public function save(Request $request){
        $project_type = $request->input();
        $ProjectType = new ProjectType($project_type);
        if (isset($project_type['id'])){
            $ProjectType->exists = true;
        }
        $ProjectType->save();
        return $ProjectType;
    }


    /*
     * Upserts project type
     * @param Request
     * @return Response
     */
    public function get_activities(Request $request){
        return ActivityStandards::all();
    }

    /*
     * Upserts activities
     * updates if ID is given
     * @param Request
     * @return Response
     */
    public function add_activities(Request $request){
        $data = $request->input();
        \DB::enableQueryLog();
        $activity_standard = new ActivityStandards($data);
        if (isset($data['id'])){
            $activity_standard->exists = true;
        }
        $result = $activity_standard->save();
        $log = \DB::getQueryLog();
        return $result?'success':'fail';
    }

    /*
     * Returns specific project type given ID
     * @param Request
     * @return Response
     */
    public function getByID(Request $request, $ID){
        \DB::enableQueryLog();
        $projectType = ProjectType::find($ID);
        return $projectType;
    }

    /*
     * Deletes selected project type
     * @param Request
     * @return Response
     */
    public function deleteByID(Request $request, $ID){
        \DB::enableQueryLog();
        $projectType = ProjectType::find($ID);
        $result = $projectType->delete();
        return $result;
    }
}
