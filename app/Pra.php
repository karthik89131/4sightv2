<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Http\Request;

use App\ActivityTrait;

class Pra extends Model
{
    protected $fillable = ['id', 'name', 'venue', 'introduction', 'project_background', 'objective', 'methodology',
        'schedule', 'other_pmt', 'other', 'status', 'planned_date_date', 'config_project_type_id',
        'project_phase_id', 'project_id', 'activity_standards_id', 'responsible_person_id',
        'created_at', 'updated_at'
    ];
    protected $table = 'project_phase_activity';
    public function _construct(){

    }

}
