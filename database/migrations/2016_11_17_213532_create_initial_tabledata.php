<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTabledata extends Migration
{
    protected $connection = 'mongodb';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection($this->connection)->table('4sight_tables', function(Blueprint $collection)
        {
            $data = [
                'table_name'=>'users',
                'fields'=>[
                    'id'=>[
                        'title'=>'ID',
                        'type'=>'number'
                    ],
                    'full_name'=>[
                        'title'=>'Full Name',
                        'type'=>'string'
                    ]
                ]
            ];
            $collection->where('table_name', '4sight_tables')
            ->update($data, ['upsert'=>true]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('4sight_tables', function (Blueprint $table) {
            //
        });
    }
}
