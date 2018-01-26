<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class PageModel extends Model
{
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $collection = 'balls';
    public function index(){
        $test = $this->where('type','=',1)->get();
        return $test;
    }
}
