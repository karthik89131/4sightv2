<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Project;
use App\Companies;
use App\Currency;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProjectsJSONController extends Controller {

	public function __construct()
	{

	}

	/**
	 * Return a view to display the list of projects
	 *
	 * @return Response
	 */
	public function index(){
        $project = new Project();
        $auth = Auth::user()->GetInfo(true);
		$projects = $project->listByUsers($auth['id']);
		return $projects;
	}

    public function types(){
        return Project::Types();
    }

    public function classifications(){
        return Project::Classifications();
    }
    public function companies(){
        return Companies::all();
    }
    public function currencies(){
        return Currency::all();
    }
    public function plant_capacity_units(){
        return Project::ConfigCapacities();
    }
    public function contracting_modes(){
        return Project::ContractingModes();
    }
    public function config_date_fields(){
        return Project::ConfigDateFields();
    }
    /**
     * Return a view to display the list of projects
     * @param Request
     * @return Response
     */
    public function save(Request $request){
        $project = $request->input();

        $project = new Project($project);
        $user = Auth::user()->GetInfo(true);
        if (isset($project['id'])){
            $hasAccess = Project::isUserAccessible($user['id'], $project['id']);
            if ($hasAccess){
                $project->exists = true;
                $results = $project->save();
            } else {

            }
        } else {
            $project->exists = false;
            $results = $project->save();
            //add user to project_users
            $user = Auth::user()->GetInfo(true);
            $project->associateUser($user['id']);
        }

        return $project;
    }

    /**
     * Retrieves specific project
     * @param Request
     * @return Response
     */
    public function get(Request $request, $project_id){
        //$project_id = $request->input();
        \DB::enableQueryLog();
        $user = Auth::user()->GetInfo(true);
        $user_id = $user['id'];
        $hasAccess = Project::isUserAccessible($user_id, $project_id);
        if (isset($hasAccess)){
            $project = Project::find($project_id);
        } else {
            $project = 'Project not found';
        }
        $log = \DB::getQueryLog();
        return $project;
    }




}
