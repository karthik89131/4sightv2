<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\InternalProject;

class InternalProjectsJSONController extends Controller {
	public function __construct()
	{
	}

	public function getprojects() {
		$result = InternalProject::getprojects();
		if (!$result) {
			return 0;
		}
		return $result;
	}
	
	public function addproject(Request $request) {
		$data = array(
			'name' => $request->input('name'),
			'start_date' => $request->input('start_date'),
			'end_date' => $request->input('end_date'),
			'description' => $request->input('description')
		);
		return InternalProject::addproject($data);
	}

	public function delproject(Request $request) {
		$projectid = $request->input('id');
/*
		if (empty($projectid) || !ctype_digit($projectid)) {
			return 0;
		}
*/		
		return InternalProject::delproject($projectid);
	}
	
	public function test2(){
        return $this->test;
    }
}
