<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('config_user_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->integer('has_access');
        });
        DB::table('config_user_status')->insert(
            array(
                'id'=>1,
                'name'=>'Active',
                'description'=>''
            )
        );
        DB::table('config_user_status')->insert(
            array(
                'id'=>2,
                'name'=>'Inactive',
                'description'=>''
            )
        );
        DB::table('config_user_status')->insert(
            array(
                'id'=>3,
                'name'=>'Banned',
                'description'=>''
            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('config_user_status');
    }
}
