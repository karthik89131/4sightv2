<?php

namespace App\Providers;

use App\User;
use App\Token;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use \Firebase\JWT\JWT;
use Mockery\CountValidator\Exception;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            if ($request->input('api_token')) {
                return Token::GetUser('api_key', $request->input('api_token'))->first();
            }
        });

        $this->app['auth']->viaRequest('token', function ($request) {
            $access_token = $request->headers->get('Authorization');

            if ($access_token) {
                $tokendata = JWT::decode($access_token, getenv('TOKEN_SECRET'), array('HS256'));

                if ($tokendata->id) {
                    return User::find($tokendata->id);
                }

                return false;
            }
        });

        /*
         * uses api_token or authorization header
         */
        $this->app['auth']->viaRequest('auth_or_api', function ($request) {
            if ($request->input('api_token')) {
                return User::where('api_key', $request->input('api_token'))->first();
            } else {
                $access_token = $request->headers->get('Authorization');

                if ($access_token) {
                    $key = getenv('TOKEN_SECRET');
                    try {
                        $tokendata = JWT::decode($access_token, $key, array('HS256'));
                    } catch(Exception $e){
                        return false;
                    }
                    if ($tokendata->id) {
                        return User::find($tokendata->id);
                    }

                    return false;
                }
            }
        });

    }
}
