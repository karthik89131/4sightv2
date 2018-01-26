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

class ActivityStandardProjectPhase extends Model
{
    const tablename = 'activity_standards_project_phase';
    protected $fillable = [
        'id', 'config_project_phase_id', 'activity_standards_id',
        'created_at', 'updated_at'
    ];
    protected $table = ActivityStandardProjectPhase::tablename;

}
