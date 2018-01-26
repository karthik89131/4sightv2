<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Http\Request;

trait BaseModel
{
    public function _construct(){

    }

    public function toJson($options = 0)
    {
        $results = parent::toJson($options);
        return $results;
    }

    public function JStoSQLtime($jsDate){
        $dt = strtotime($jsDate);
        return date("Y-m-d H:i:s", $dt);
    }

    public function fixDates(&$dataArr, $fieldArr){
        foreach ($fieldArr as $fieldItem){
            if (isset($dataArr[$fieldItem])){
                $dataArr[$fieldItem] = $this->JStoSQLtime($dataArr[$fieldItem]);
            } else {
                unset($dataArr[$fieldItem]);
            }
        }
    }
}
