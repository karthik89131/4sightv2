<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Http\Request;

class ProjectUser extends Model
{
    protected $fillable = [
        'user_id', 'project_id'];
    protected $table = 'project_user';
    public function _construct(){

    }
}
