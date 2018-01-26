<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use App\Helpers\TokenHelper;

class Token extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    protected $table = 'tokens';

    public static function authenticate($token){
        $user = DB::table('tokens')->where('token', $token)->first();
        if ($user){
            return $user;
        } else {
            return false;
        }
    }

    public function GetUser(){
        return $this->belongsTo('App\User');
    }

    public static function StoreToken($userId, $tokenKey){
        $newToken = new Token;
        $newToken->user_id = $userId;
        $newToken->token = $tokenKey;
        $newToken->save();
    }

    public static function MakeToken($userId){
        $newToken = new Token;
        $tokenKey = TokenHelper::generate_api_token();
        $newToken->token = $tokenKey;
        $newToken->user_id = $userId;
        $newToken->save();

        return $tokenKey;
    }

    public function toJson($int = 0){
        return [
            'token'=>$this->attributes['token'],
            'created_at'=>$this->attributes['created_at']
        ];
    }

}
