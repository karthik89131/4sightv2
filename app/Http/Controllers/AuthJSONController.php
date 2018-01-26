<?php namespace App\Http\Controllers;
use App\Helpers\TokenHelper;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use App\User;
use App\Token;
use \Firebase\JWT\JWT;

class AuthJSONController extends Controller {

	public function __construct()
	{

	}

	/**
	 * Return a view to display the list of projects
	 * @param Request
	 * @return Response
	 */
	public function login(Request $request)
	{
        $username = $request->input('username');
        $password = $request->input('password');
        $users = new User();
        $user = $users->Authenticate($username,$password);
        if ($user){
            $key = getenv('TOKEN_SECRET');
            $id = $user['id'];
            $token = Token::MakeToken($user['id']);

            $access_token = [
                'id'=>$id,
                'token'=>$token
            ];

            $auth_header = JWT::encode($access_token, $key);
            return $auth_header;
        } else {
            return new Response('fail', Response::HTTP_UNAUTHORIZED);
        }
	}

    /**
     * Return a view to display the list of projects
     *
     * @return Response
     */
    public function logout(Request $request)
    {
        return 'success';
    }

}
