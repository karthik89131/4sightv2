<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\ProjectPhaseActivities;
use App\ProjectPhaseActivitiesPRA;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Pra;
use App\Companies;
use App\Currency;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\BaseModel;

class PraJSONController extends Controller {
    use BaseModel;

    public function __construct()
    {

    }

    public function can_access($user_id, $project_or_risk_id){
        //return
    }

    /**
     * Return a view to display the list of projects
     *
     * @return Response
     */
    public function index(){
        $pra = new Pra();
        $auth = Auth::user()->GetInfo(true);
        //$risks = $risk->listByUsers($auth['id'])->get();
        //return $risks;
    }

    /**
     * get PRA activity given activity_id
     * @param Request
     * @return Response
     */
    public function getPRAFromActivity(Request $request, $id){
//        $movies = Movie::join("lang_movies", "movies.id", "=", "lang_movies.lang_movie_id")
//            ->join("movie_categories", "movies.id", "=", "movie_categories.mc_movie_id")
//            ->join("categories_movie", "movie_categories.mc_category_id", "=", "categories_movie.id")
//            ->join("lang_categories_movie", "categories_movie.id", "=", "lang_categories_movie.lang_cm_id")
//            ->where('lang_movies.lang_id', $lid)
//            ->where('lang_categories_movie.lang_id', $lid);
//        $movies = $movies->select("movies.*", "lang_movies.lang_movie_name", "lang_movies.lang_movie_description", "lang_categories_movie.lang_cm_name", "movie_categories.mc_category_id", "categories_movie.cm_parent")
//            ->get();
//
//        return $movies;

        $activity = ProjectPhaseActivities::join("project", "project_phase_activity.project_id", "=", "project.id")
                                            ->join("project_phase", "project_phase_activity.project_id", "=", "project_phase.id")
                                            ->where('project_phase_activity.id', $id);
        $activity = $activity->select("project_phase_activity.*", "project.name", "project_phase.name AS phase_name")->first();
        $pra = ProjectPhaseActivitiesPRA::where('project_phase_activity_id', $id)->first();
        if ($pra==null){
            $pra = [
              'project_phase_activity'=>$activity
            ];
        } else {
            $pra->attributes['project_phase_activity'] = $activity;
        }


        return $pra;
    }
    /**
     * save a new risk item
     * if no ID is given, it will be saved as new
     * @param Request
     * @return Response
     */
    public function save(Request $request){
        $data = $request->input();

        $project_phase_activities_pra = new ProjectPhaseActivitiesPRA($data);
        //$project_phase_activities_pra->exists = true;

        $project_phase_activities_pra->save();
    }
    /**
     * save a new risk item
     * if no ID is given, it will be saved as new
     * @param Request
     * @return Response
     */
    public function delete(Request $request, $id){
        $risk = Risk::find($id);
        $result = $risk->delete();
        if ($result){
            return 'success';
        } else {
            return 'fail';
        }
    }
}
