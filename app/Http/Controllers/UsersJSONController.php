<?php namespace App\Http\Controllers;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Redis;
class UsersJSONController extends Controller {

	public function __construct()
	{

	}

	/**
     * Admin Area
	 * Return a view to display the list of users
	 *
	 * @return Response
	 */
	public function index()
	{
        return User::Listing();
	}

	/*
	 * Shows current logged in user
	 * @param Request
	 */
    public function me(Request $request, Auth $auth){
        $auth = Auth::user()->GetInfo(true);
        return $auth;
    }

    public function test(){
        $retData = json_encode(['foo' => 'bar']);
        Redis::publish('falling_edge', $retData);
        return $retData;
    }

}
