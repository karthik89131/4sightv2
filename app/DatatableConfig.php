<?php
namespace App;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;


class DatatableConfig extends Model
{

    use HybridRelations;
    protected $connection = 'mongodb';
    protected $collection = 'tables';

    public static function getTables($table_name){
        return static::where('table_name','=',$table_name)->get();
    }

    public static function setTables($table_name, $fields){
        $data = $fields;
        $data['table_name'] = $table_name;
        return static::where('table_name',$table_name)
            ->update($data, ['upsert'=>true]);
    }

    public static function listTables(){
        return static::all();
    }
}
