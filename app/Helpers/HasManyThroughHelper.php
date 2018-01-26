<?php
namespace Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class HasManyThroughHelper extends HasManyThrough
{
    public function setSecondKey($val){
        $this->secondKey = $val;
    }
}