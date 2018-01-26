<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Risk;
use App\Companies;
use App\Currency;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\BaseModel;

class RiskJSONController extends Controller {
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
        $risk = new Risk();
        $auth = Auth::user()->GetInfo(true);
        $risks = $risk->listByUsers($auth['id'])->get();
		return $risks;
	}
    /**
     * save a new risk item
     * if no ID is given, it will be saved as new
     * @param Request
     * @return Response
     */
	public function save(Request $request){
        $data = $request->input();
        //TODO: check if user has risk role
        $auth = Auth::user()->GetInfo(true);
        // else
        //TODO: check if user has access to project
        $user_id = $auth;
        $project_id = $data['project_id'];

        $this->fixDates($data, ['created_at', 'updated_at', 'action_due']);
	    $risk = new Risk($data);
	    if (isset($data['id'])){
	        $risk->exists = true;
        }
        try{
            $saved = $risk->save();
            if ($saved){
                return $risk;
            }
        } catch (\Exception $e){
	        return $e->getMessage();
        }
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
