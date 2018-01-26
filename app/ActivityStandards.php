<?php
/*
 * this is to create activity standards
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Http\Request;

use App\ActivityTrait;

class ActivityStandards extends Model
{
    protected $fillable = [
        'id', 'activity_name', 'activity_introduction', 'activity_description',
        'activity_type', 'config_project_type_id'
    ];
    protected $table = 'activity_standards';

}
