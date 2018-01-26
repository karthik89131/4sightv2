<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use App\Helpers\TokenHelper;


class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password_hash'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password','password_hash','forgot_password_token'
    ];

    protected $table = 'user';

    public function index(){
        return 'test';
    }

    public function authenticate($username, $password){
        $user = $this->where('email', $username)->first();
        if ($user){
            $pass = $user->attributes['password_hash'];
            if ($password==TokenHelper::decode_password($pass)){
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function GetInfo($shouldSendAPIKey = false){
        $id = $this->attributes['id'];
        $resp = [
            'id'=>$id,
            'full_name'=>$this->attributes['full_name']
        ];
        if ($shouldSendAPIKey){
            $tokens = $this->GetStoredTokens()->get(['token', 'created_at']);
            $resp['api_key'] = $tokens;
        }
        $resp['attributes'] = $this->GetUserEAV();
        return $resp;
    }

    public function GetUserEAV(){
        $userAttributes = new UserAttributes();
        $userAttributesList = new UserAttributesList();
        $userAttributes_table = $userAttributes->getTable();
        $userAttributesList_table = $userAttributesList->getTable();
        $results = \DB::select('select A.value,B.name from '.$userAttributes_table.
            ' as A left join '. $userAttributesList_table .' as B'.
            ' on A.user_attributes_type_id=B.id'.
            ' where user_id=?', [$this->attributes['id']]);
        //return $this->hasMany('App\UserAttributes');
        return $results;
    }

    public function GetStoredTokens(){
        return $this->hasMany('App\Token');
    }

    public static function listing(){
        $users =  static::all();
        /*$users_ = [];
        foreach ($users as $user){
            $users_[] = new User($user);
        }*/
        return $users;
    }
}
